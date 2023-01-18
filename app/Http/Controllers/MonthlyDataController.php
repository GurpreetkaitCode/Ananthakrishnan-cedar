<?php

namespace App\Http\Controllers;;

use App\Http\Controllers\Controller;
// use App\Models\Settings;
use App\Models\Session;
use App\Models\User as Admin;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MonthlyDataController extends Controller
{
    public function show(Request $request)
    {

        $year = $request->input("year");
        $month = $request->input("month");

        if ($year == null || $month == null) {
            $year = date("Y");
            $allReserve = [];
        } else {
            // dd([$year, $month]);
            $year = (int)$year;
            $month = (int)$month;
            $date_from = date("Y-m-d", strtotime("$year-$month-01"));
            $date_to = date("Y-m-d", strtotime("$year-$month-31"));
            $allReserve = Reservation::whereBetween('check_in', [$date_from, $date_to])->get();
        }

        return view('admin.monthlydata', [
            "year" => $year,
            "month" => $month,
            "reservations" => $allReserve,
            "pagename" => "Monthly data",
        ]);
    }
}
