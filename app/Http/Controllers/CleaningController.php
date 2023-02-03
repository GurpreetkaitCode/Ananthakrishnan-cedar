<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CleaningController extends Controller
{
    public function show(Request $request)
    {
        $year = '';
        $month = '';
        if ($request->year != null && $request->month != null) {
            $year = $request->year;
            $month = $request->month;
            $from = Carbon::createFromDate($year, $month, 1)->startofMonth();
            $to = Carbon::createFromDate($year, $month, 1)->endOfMonth();
            $records = DB::table('reservation')->whereBetween('check_in',[$from,$to])->orderBy('check_in')->get();
        } else {
            $records = [];
        }
        return view('admin.cleaning', compact('records', 'year', 'month'));
    }

    public function update(Request $request)
    {
        $record = Reservation::find($request->id);
        $record->notes = $request->notes;
        $record->save();
        return back()->with('success', 'Notes added successfully');
    }
}
