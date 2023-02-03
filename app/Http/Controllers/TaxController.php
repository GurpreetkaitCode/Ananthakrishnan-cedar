<?php

namespace App\Http\Controllers;

use App\Models\ExpenseModel;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaxController extends Controller
{
    public function show(Request $request)
    {
        $totalIncome = 0;
        $totalCost = 0;
        $totalProfit = 0;
        $totalOcc = 0;
        $totalCap = 0;
        $totalDays = 0;
        if (
            $request->plot == null && $request->type == null
        ) {
            $records = [];
            $fromyear = null;
            $frommonth = null;
            $toyear = null;
            $type = 0;
            $plot = 0;
            $tomonth = null;
        } else {
            $type = $request->type;
            $plot = $request->plot;
            $toyear = $request->toYear;
            $tomonth = $request->toMonth;
            $fromyear = $request->fromYear;
            $frommonth = $request->fromMonth;
            $to = Carbon::createFromDate($toyear, $tomonth, 1)->endOfMonth();
            $from = Carbon::createFromDate($fromyear, $frommonth, 1);
            $reserves = DB::table('reservation')
                ->select(DB::raw("DATE_FORMAT(check_in, '%M %Y') as month,
                                 SUM(revenue) as income, 
                                 SUM(DATEDIFF(check_out, check_in)) as totaldays"))
                ->whereBetween('check_in', [$from, $to])
                ->groupBy(DB::raw("DATE_FORMAT(check_in, '%M %Y')"))
                ->get();
            $allMonths = [];
            $start = new DateTime($from);
            $end = new DateTime($to);
            $interval = DateInterval::createFromDateString('1 month');
            $period = new DatePeriod($start, $interval, $end);

            foreach ($period as $dt) {
                $allMonths[$dt->format("F Y")] = [
                    "month" => $dt->format("F Y"),
                    "income" => 0,
                    "totaldays" => 0,
                    'cost' => 0,
                    'profit' => 0,
                    'grossprofit' => 0,
                    'variablecost' => 0,
                    'occ' => 0
                ];
            }
            $nettotalearnings = 0;
            $nettotalcost = 0;
            $nettotalprofit = 0;
            $nettotaldays = 0;
            foreach ($reserves as $reserve) {
                $explod = explode(" ", $reserve->month);
                $year = $explod[1];
                $cost = ExpenseModel::whereMonth('date', $this->month_name_to_number($explod[0]))->whereYear('date', $year)->value('amount');
                $capitalexpenditure = ExpenseModel::whereMonth('date', $this->month_name_to_number($explod[0]))->where('expensecategory_id', 2)->whereYear('date', $year)->value('amount');
                $date = new DateTime("$year-$reserve->month"); // August 2022
                $date->modify('last day of this month');
                $lastdayofmonth = $date->format('d');
                $profit = $reserve->income - $cost;
                $grossprofit = $reserve->income - $capitalexpenditure;
                $occ = round(($reserve->totaldays / $lastdayofmonth) * 100);
                $allMonths[date('F Y', strtotime($reserve->month))] = [
                    'month' => date('F Y', strtotime($reserve->month)),
                    'cost' => $cost,
                    'income' => $reserve->income,
                    'profit' => $profit,
                    'grossprofit' => $grossprofit,
                    'variablecost' => $capitalexpenditure,
                    'occ' => $occ
                ];
                $nettotalearnings += $reserve->income;
                $nettotalcost += $cost;
                $nettotalprofit += $profit;
                $nettotaldays += $reserve->totaldays +1;
            }
            $totalIncome = $nettotalearnings;
            $totalCost = $nettotalcost;
            $totalProfit = $nettotalprofit;
            $totalDays = $nettotaldays;

            $totalOcc = round(($totalDays / 356) * 100, 1);
            $cost = DB::table('expenses')->whereBetween('date', [$from, $to])->get();
            $totalCap = $cost->sum('amount');
            $records = $allMonths;
        }
        return view('admin.tax', compact('records', 'fromyear', 'frommonth', 'toyear', 'tomonth', 'type', 'plot', 'totalIncome', 'totalCost', 'totalProfit', 'totalOcc', 'totalCap'));
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
