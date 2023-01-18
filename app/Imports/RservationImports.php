<?php

namespace App\Imports;

use App\Models\Reservation;
use Carbon\Carbon;
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
        // dd($row);
        $reservationNo  = $row['reservation_no'];
        $guest_first_name = $row['guest_first_name'];
        $guest_last_name = $row['guest_last_name'];
        $email = $row['email'];
        $country = $row['country'];
        $check_in_date = $row['check_in_date'];
        $check_in_date = PHPExcel_Shared_Date::ExcelToPHP($check_in_date);
        $check_in_date = date('Y-m-d', $check_in_date);
        $check_out_date = $row['check_out_date'];
        $check_out_date = PHPExcel_Shared_Date::ExcelToPHP($check_out_date);
        $check_out_date = date('Y-m-d', $check_out_date);
        $room = $row['room'];
        $unit_no = $row['unit_no'];
        $subtotal = $row['subtotal'];
        $revenue = $row['revenue'];
        $currency = $row['currency'];
        $create_date = $row['create_date'];
        $create_date = PHPExcel_Shared_Date::ExcelToPHP($create_date);
        $create_date = date('Y-m-d', $create_date);

        return new Reservation([
            'reservation_no' => $reservationNo,
            'guest_first_name' => $guest_first_name,
            'guest_last_name' => $guest_last_name,
            'email' => $email,
            'country' => $country,
            'check_in' => Carbon::parse($check_in_date)->format('Y-m-d'),
            'check_out' => Carbon::parse($check_out_date)->format('Y-m-d'),
            'room' => $room,
            'unit_no' => $unit_no,
            'subtotal' => $subtotal,
            'revenue' => $revenue,
            'create_date' => Carbon::parse($create_date)->format('Y-m-d'),
            'sub_total' => $subtotal,
            'adults' => null,
            'children' => null,
            'notes' => null,
            'total_days' => null,
            'currency' => $currency,
        ]);
    }
}
