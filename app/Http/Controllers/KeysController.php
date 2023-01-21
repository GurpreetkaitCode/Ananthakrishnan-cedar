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
            $dateFrom = Carbon::createFromFormat("d.m.Y", "01." . $month . "." . $year)->startOfDay();
            $lastDayOfMonth = Carbon::createFromFormat("d.m.Y", $year . "-" . $month . "-01")->endOfMonth()->day;
            $dateTo = Carbon::createFromFormat("d.m.Y", $lastDayOfMonth . "." . $month . "." . $year)->endOfDay();
            $allReserve = Reservation::where("check_in", ">=", $dateFrom)
                ->where("check_in", "<=", $dateTo)->get();
        }
        return view("admin.keys", ["year" => $year, "month" => $month, "all_reserve" => $allReserve, "pagename" => "Key management", "name" => Auth::user()->name]);
    }
}
