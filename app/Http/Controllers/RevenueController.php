<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\SettingModel;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    public function show(Request $request)
    {
        $settings = SettingModel::all()->first();
        $typ = $request->input('type');
        $plot = $request->input('plot');

        if (!$plot || !$typ) {
            return view('admin.revenue', [
                'plot' => $plot, 'type' => $typ, 'all_reserve' => [], 'settings' => $settings,
            ]);
        } else {
            $typ = intval($typ);
            $plot = intval($plot);
            if ($typ == 0) {
                $year = intval($request->input('year'));
                $d_fmt = "{0:>02}.{1:>02}.{2}";
                $date_from = date_create_from_format('d.m.Y', $d_fmt . format(1, 1, $year));
                $date_to = date_create_from_format('d.m.Y', $d_fmt . format(31, 12, $year));
                $allReserve = Reservation::whereBetween('check_in', [$date_from, $date_to])->get();
                $res = [];
                $totInc = 0;
                $tD = 0;
                for ($i = 1; $i <= 12; $i++) {
                    $date_from = date_create_from_format('d.m.Y', $d_fmt . format(1, $i, $year));
                    // $last_day_of
                }
            }
            return view('admin.revenue');
        }
    }
}
