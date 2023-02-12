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
//        dd($request);
        $data = request()->validate([
            'guest_first_name'=>'required',
            'guest_last_name'=> 'required',
            'email' => 'required',
            'room' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
        ]);
        $firstname = $request->guest_first_name;
        $lastname = $request->guest_last_name;
        $email = $request->email;
        $room = $request->room;
        $checkin = $request->check_in;
        $checkout = $request->check_out;
        $country = $request->country;
        $unitno = $request->unit_no;
        $revenue = $request->revenue;
        $adults = $request->adults;
        $notes = $request->notes;
        $children = $request->children;
        $id = $request->input("id");
        try {
            $data = ['guest_first_name' => $firstname,'guest_last_name' =>$lastname,'email' => $email,'room' => $room,
                'check_in' => date('Y-m-d',strtotime($checkin)),'check_out'=>date('Y-m-d',strtotime($checkout)),
                'country'=>$country,'notes'=>$notes,'unit_no'=>$unitno,'revenue'=>$revenue,'adults'=>$adults,'children'=>$children,
            ];
            DB::table('reservation')->where('id',$id)->update($data);
        }catch (Exception $exception){
            return back()->with('error',$exception->getMessage());
        }
        return back()->with('success', 'Monthly data updated successfully');
    }
}
