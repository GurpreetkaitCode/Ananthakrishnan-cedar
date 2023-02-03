<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\SettingModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeysController extends Controller
{
    public function show(Request $request)
    {
        $year = $request->year;
        $month = $request->month;
        if (!$year || !$month) {
            $allReserve = [];
        } else {
            $from = Carbon::create($year, $month, 1, 0, 0, 0);
            $to = Carbon::create($year, $month, 1, 0, 0, 0)->addMonth();
            $allReserve = Reservation::whereBetween('check_in',[$from,$to])->get();
        }
        $records = $allReserve;
        return view("admin.keys", ["year" => $year, "month" => $month, "records" => $records, "pagename" => "Key management", "name" => Auth::user()->name]);
    }

    public function update(Request $request)
    {
        $record = Reservation::find($request->id);
        try {
            $record->check_in_time = $request->check_in_time;
            $record->check_out_time = $request->check_out_time;
            $record->save();
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
        return back()->with('success', 'Settings updated successfully');
    }
}
