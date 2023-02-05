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
            $month = date("m");
            $allReserve = Reservation::whereMonth('check_in', $month)->whereYear('check_in', $year)->orderBy('check_in')->get();
        } else {
            // dd([$year, $month]);
            $year = (int)$year;
            $month = (int)$month;
            $date_from = date("Y-m-d", strtotime("$year-$month-01"));
            $date_to = date("Y-m-d", strtotime("$year-$month-31"));
            $allReserve = Reservation::whereBetween('check_in', [$date_from, $date_to])->orderBy('check_in')->get();
        }

        return view('admin.monthlydata', [
            "year" => $year,
            "month" => $month,
            "reservations" => $allReserve,
            "pagename" => "Monthly data",
        ]);
    }

    public function update(Request $request)
    {
        request()->validate([
            'revenue' => 'required',
        ]);

        $revenue = $request->input("revenue");
        $id = $request->input("id");

        $reservation = Reservation::find($id);
        $reservation->revenue = $revenue;
        $reservation->save();

        return back()->with('success', 'Monthly data updated successfully');
    }
}
