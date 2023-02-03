<?php

namespace App\Http\Controllers;

use App\Models\ExpenseModel;
use App\Models\Reservation;
use App\Models\SettingModel;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RevenueController extends Controller
{
    public function show(Request $request)
    {
        $frommonth = $request->fromMonth;
        $tomonth = $request->toMonth;
        $fromyear = $request->fromYear;
        $toyear = $request->toYear;
        $year = $request->year;
        $type = $request->type;
        $plot = $request->plot;
        if (empty($plot) && empty($type) && empty($year)) {
            $plot = 0;
            $type = 0;
            $records = [];
            return view('admin.revenue', compact('plot', 'type', 'frommonth', 'tomonth', 'fromyear', 'toyear', 'year', 'records'));
        }
        if ($year) {
            $from = Carbon::createFromDate($year, 1, 1);
            $to = Carbon::createFromDate($year, 12, 1)->endOfMonth();
            $totalIncome = 0;
            $totalCost = 0;
            $totalProfit = 0;
            $totalOcc = 0;
            $totalCap = 0;
            $totalDays = 0;

            $start = new DateTime($from);
            $end = new DateTime($to);
            $interval = DateInterval::createFromDateString('1 month');
            $period = new DatePeriod($start, $interval, $end);
            $allMonths = [];
            foreach ($period as $dt) {
                $allMonths[$dt->format("F Y")] = [
                    "month" => $dt->format("F"),
                    "income" => 0,
                    "bookings" => 0,
                    'averageLength' => 0,
                    'totalincome' => 0,
                    'variablecost' => 0,
                    'grossprofit' => 0,
                    'occupancy' => 0,
                ];
            }
            $reserves = DB::table('reservation')
                ->select(DB::raw("DATE_FORMAT(check_in, '%M %Y') as month,
                             SUM(revenue) as income, 
                             COUNT(DISTINCT check_in) as bookings,
                             SUM(DATEDIFF(check_out, check_in)) as totaldays"))
                ->whereBetween('check_in', [$from, $to])
                ->groupBy(DB::raw("DATE_FORMAT(check_in, '%M %Y')"))
                ->orderBy('check_in', 'asc')
                ->get();
            $nettotaldays = 0;
            foreach ($reserves as $reserve) {
                $date = explode(" ", $reserve->month);
                $month = $date[0];

                $lastdayofmonth = date('t', strtotime($reserve->month));
                $cost = ExpenseModel::whereMonth('date', $this->month_name_to_number($month))->whereYear('date', $year)->value('amount');
                $profit = $reserve->income - $cost;

                $allMonths[date('F Y', strtotime($reserve->month))] = [
                    'month' => $month,
                    'income' => $reserve->income,
                    'book2ings' => $reserve->bookings,
                    'averageLength' => round($reserve->totaldays / $reserve->bookings, 1),
                    'totaldays' => $reserve->totaldays,
                    'profit' => $profit,
                    'occ' => round(($reserve->totaldays / $lastdayofmonth) * 100)
                ];
                $totalIncome += $reserve->income;
                $totalCost += $cost;
                $totalProfit += $profit;
                $nettotaldays += $reserve->totaldays;
                $totalDays = $nettotaldays;
            }
            $cost = DB::table('expenses')->whereBetween('date', [$from, $to])->get();
            $totalCap = $cost->sum('amount');
            $totalOcc = round(($totalDays / 365) * 100, 1);
            $records = $allMonths;
            return view('admin.revenue', compact('type', 'plot', 'frommonth', 'tomonth', 'fromyear', 'toyear', 'year', 'records', 'totalIncome', 'totalCost', 'totalProfit', 'totalOcc', 'totalCap'));
        }
        if ($fromyear && $toyear) {
            $totalIncome = 0;
            $totalCost = 0;
            $totalProfit = 0;
            $totalOcc = 0;
            $totalCap = 0;
            $totalDays = 0;
            $to = Carbon::createFromDate($toyear, $tomonth, 1)->endOfMonth();
            $from = Carbon::createFromDate($fromyear, $frommonth, 1);
            $reserves = DB::table('reservation')
                ->select(DB::raw("DATE_FORMAT(check_in, '%M %Y') as month,
                         SUM(revenue) as income, 
                         COUNT(DISTINCT check_in) as bookings,
                         SUM(DATEDIFF(check_out, check_in)) as totaldays"))
                ->whereBetween('check_in', [$from, $to])
                ->groupBy(DB::raw("DATE_FORMAT(check_in, '%M %Y')"))
                ->orderBy('check_in', 'asc')
                ->get();
            $nettotaldays = 0;
            foreach ($reserves as $reserve) {
                $date = explode(" ", $reserve->month);
                $month = $date[0];
                $year = $date[1];
                $lastdayofmonth = date('t', strtotime($reserve->month));
                $cost = ExpenseModel::whereMonth('date', $this->month_name_to_number($month))->whereYear('date', $year)->value('amount');
                $capexpenditure = ExpenseModel::whereMonth('date', $this->month_name_to_number($month))->where('expensecategory_id', 2)->whereYear('date', $year)->value('amount');
                // print_r($month);
                // print_r( $capexpenditure);
                // echo ' ';
                // print_r($reserve->income - $capexpenditure);
                // echo '<br>';
                $grossprofit = $reserve->income - $capexpenditure;
                $totalDays = $reserve->totaldays + 1;
                $profit = $reserve->income - $cost;
                $allMonths[date('F Y', strtotime($reserve->month))] = [
                    'month' => $reserve->month,
                    'income' => $reserve->income,
                    'bookings' => $reserve->bookings,
                    'averageLength' => round($totalDays / $reserve->bookings, 1),
                    'totaldays' => $reserve->totaldays + 1,
                    'variablecost' => $capexpenditure,
                    'grossprofit' => $grossprofit,
                    'profit' => $reserve->income - $cost,
                    'occ' => round(($totalDays / $lastdayofmonth) * 100)
                ];
                $totalIncome += $reserve->income;
                $totalCost += $cost;
                $totalProfit += $profit;
                $nettotaldays += $totalDays;
            }
            $totalDays = $nettotaldays;
            // die;
            $cost = DB::table('expenses')->whereBetween('date', [$from, $to])->get();
            $totalCap = $cost->sum('amount');
            $totalOcc = round(($totalDays / 365) * 100, 1);
            $records = $allMonths;
            return view('admin.revenue', compact('type', 'plot', 'frommonth', 'tomonth', 'fromyear', 'toyear', 'year', 'records', 'totalIncome', 'totalCost', 'totalProfit', 'totalOcc', 'totalCap'));
        }
    }
    public function month_name_to_number($month_name)
    {
        $months = array(
            "January" => 1,
            "February" => 2,
            "March" => 3,
            "April" => 4,
            "May" => 5,
            "June" => 6,
            "July" => 7,
            "August" => 8,
            "September" => 9,
            "October" => 10,
            "November" => 11,
            "December" => 12
        );
        return $months[$month_name];
    }
}
