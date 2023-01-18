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
            $file = fopen($icsfile, "r");
            $inEvent = false;
            while (!feof($file)) {
                $line = fgets($file);
                if (strpos($line, "BEGIN:VEVENT") !== false) {
                    $inEvent = true;
                } elseif (strpos($line, "END:VEVENT") !== false) {
                    $inEvent = false;
                }
                if ($inEvent && strpos($line, "SUMMARY:") !== false) {
                    preg_match("/occupancy: (.*) \((.*)\)/", $line, $occ);
                    preg_match("/Reservation: #(.*)\,/", $line, $reservation);
                    $reservationNo = intval($reservation[1] ?? '');
                }
                if ($inEvent && strpos($line, "cy:") !== false) {
                    preg_match("/adults\children: (.*) \((.*)\)/", $line, $occ);
                    preg_match("/adults\/children \((.*)\/(.*)\)/", $line, $occ);
                    $adult = intval($occ[1] ?? '');
                    $child = intval($occ[2] ?? '');
                }
                Reservation::where('reservation_no', $reservationNo ?? '')->update(['adults' => $adult ?? '', 'children' => $child ?? '']);
            }
            DB::commit();
            return back()->with('success', 'Uploaded successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            $error = $e->getMessage();
            return back()->with('error', 'Transaction failed. Error: ' . $error);
        }
    }

}