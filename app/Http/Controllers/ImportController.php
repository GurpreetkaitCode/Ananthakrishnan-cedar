<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\RservationImports;
use App\Jobs\ImportXlsx;
use App\Models\Reservation;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function importExcel(Request $request)
    {
        // dd($request);
        $request->validate([
            'excel_file' => 'required|file',
            'ics_file' => 'required|file'
        ]);
        $file = $request->file('excel_file');
        $icsfile = $request->file('ics_file');
        try {
            DB::beginTransaction();
            Excel::import(new RservationImports, $file);
            $content = file_get_contents($icsfile);
            $content = explode("BEGIN:VEVENT", trim($content));
            if ($content) {
                $reservation_number = null;
                $adult = 0;
                $child = 0;
                $description = null;
                foreach ($content as $key => $value) {
                    if ($key == 0) continue;
                    $summary = explode("SUMMARY:", trim($value));

                    foreach ($summary as $key => $line) {
                        if ($key == 0) continue;
                        if (preg_match('/Reservation: #(\d+)/', $line, $matches)) {
                            $reservation_number = $matches[1];
                        }
                        if (strpos($line, "cy:") !== false) {
                            preg_match("/adults\children: (.*) \((.*)\)/", $line, $occ);
                            preg_match("/adults\/children \((.*)\/(.*)\)/", $line, $occ);
                            $adult = intval($occ[1] ?? '');
                            $child = intval($occ[2] ?? '');
                        }
                        if (strpos($line, "DESCRIPTION:") !== false) {
                            preg_match("/DESCRIPTION:(.*)/", $line, $desc);
                            $description = $desc[1] ?? '';
                        }
                    }
                    $this->processReservation($reservation_number, $adult, $child, $description);
                    $description = null;
                    $adult = 0;
                    $child = 0;
                    $reservation_number = null;
                }
            }
            DB::commit();
            return back()->with('success', 'Uploaded successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            $error = $e->getMessage();
            return back()->with('error', 'Transaction failed. Error: ' . $error);
        }
    }
    function processReservation($reservationNo, $adult, $child, $description)
    {
        $reserves = DB::table('reservation')
            ->select(DB::raw("SUM(DATEDIFF(check_out, check_in)) as totaldays"))->where('reservation_no', $reservationNo ?? null)
            ->value('totaldays');
        Reservation::where('reservation_no', $reservationNo ?? null)->update(['adults' => $adult ?? 0, 'children' => $child ?? 0, 'total_days' => $reserves ?? null, 'notes' => $description ?? null]);
    }
}
