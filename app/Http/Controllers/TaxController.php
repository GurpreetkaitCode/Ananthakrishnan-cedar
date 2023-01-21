<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaxController extends Controller
{
    public function show(Request $request)
    {
        if (
            $request->plot == null && $request->type == null
        ) {
            return view('admin.tax');
        } else {
            $type = $request->type;
            $plot = $request->plot;
            $toyear = $request->toyear;
            $tomonth = $request->tomonth;
            $fromyear = $request->fromyear;
            $frommonth = $request->frommonth;
            $to = Carbon::createFromDate($toyear, $tomonth, 1)->endOfMonth();
            $from = Carbon::createFromDate($fromyear, $frommonth, 1);

            for ($i = 1; $i < 13; $i++) {
                $month = $i;
                DB::table('reservation')->whereMonth('check_in', $i);
            }
        }
    }
}
