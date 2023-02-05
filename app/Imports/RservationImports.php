<?php

namespace App\Imports;

use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithFormatData;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PHPExcel_Shared_Date;

class RservationImports implements ToModel, WithHeadingRow, WithFormatData
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $today = Carbon::today()->format('Y-m-d');
        $check_in_date = $row['check_in_date'];
        $check_in_date = PHPExcel_Shared_Date::ExcelToPHP($check_in_date);
        $check_in_date = Carbon::createFromTimestamp($check_in_date)->toDateString();
        // checkout date
        $check_out_date = $row['check_out_date'];
        $check_out_date = PHPExcel_Shared_Date::ExcelToPHP($check_out_date);
        $check_out_date = Carbon::createFromTimestamp($check_out_date)->toDateString();
        // created date
        $create_date = $row['create_date'];
        $create_date = PHPExcel_Shared_Date::ExcelToPHP($create_date);
        $create_date = Carbon::createFromTimestamp($create_date)->toDateString();
        $reservationNo  = $row['reservation_no'];
        $check_out_time = DB::table('settings')->value('check_out_time');
        $check_in_time = DB::table('settings')->value('check_in_time');
        $guest_first_name = $row['guest_first_name'];
        $guest_last_name = $row['guest_last_name'];
        $email = $row['email'];
        $country = $row['country'];
        $room = $row['room'];
        $unit_no = $row['unit_no'];
        $subtotal = $row['subtotal'];
        $revenue = $row['revenue'];
        $currency = $row['currency'];
        if ($check_in_date >= $today) {
            DB::table('reservation')->whereDate('check_in', $check_in_date)->delete();
        }
        if (DB::table('reservation')->whereDate('check_in', $check_in_date)->exists()) {
            DB::table('reservation')->where('reservation_no', $reservationNo)->update(
                [
                    'reservation_no' => $reservationNo,
                    'guest_first_name' => $guest_first_name,
                    'guest_last_name' => $guest_last_name,
                    'email' => $email,
                    'country' => $country,
                    'check_in' => $check_in_date,
                    'check_out' => $check_out_date,
                    'room' => $room,
                    'unit_no' => $unit_no,
                    'sub_total' => $subtotal,
                    'revenue' =>  $revenue,
                    'currency' =>   $currency,
                    'create_date' => $create_date,
                ]
            );
        }
        return new Reservation([
            'reservation_no' => $reservationNo,
            'guest_first_name' => $guest_first_name,
            'guest_last_name' => $guest_last_name,
            'email' => $email,
            'country' => $country,
            'check_in' => $check_in_date,
            'check_out' => $check_out_date,
            'room' => $room,
            'unit_no' => $unit_no,
            'subtotal' => $subtotal,
            'revenue' => $revenue,
            'create_date' => $create_date,
            'sub_total' => $subtotal,
            'adults' => null,
            'children' => null,
            'notes' => null,
            'total_days' => null,
            'currency' => $currency,
            'check_in_time' => $check_in_time,
            'check_out_time' => $check_out_time,
        ]);
    }
}
