<?php

namespace App\Http\Controllers;

use App\Models\ExpenseModel;
use App\Models\ExpensesCategoryModel;
use App\Models\ExpenseTypeModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CostController extends Controller
{
    public function show(Request $request)
    {
        $costCategories = ExpensesCategoryModel::all();
        $expensestypes = ExpenseTypeModel::all();
        $fromyear = 0;
        $frommonth = 0;
        $toyear = 0;
        $tomonth = 0;
        if ($request->fromyear && $request->frommonth && $request->toyear && $request->tomonth) {
            $from = Carbon::createFromDate($request->fromyear, $request->frommonth, 1);
            $to = Carbon::createFromDate($request->toyear, $request->tomonth, 1)->endOfMonth();
            $expenses = ExpenseModel::where('expensecategory_id', 1)->whereBetween('date', [$from, $to])->with('getExpenseType')->get();
            $fromyear = $request->fromyear;
            $frommonth = $request->frommonth;
            $toyear = $request->toyear;
            $tomonth = $request->tomonth;
        } else {
            $expenses = ExpenseModel::where('expensecategory_id', 1)->with('getExpenseType')->get();
        }
        return view('admin.costs', compact('costCategories', 'expensestypes', 'expenses', 'fromyear', 'frommonth', 'toyear', 'tomonth'));
    }

    public function deleteCost(Request $request)
    {
        request()->validate([
            'id' => 'required',
        ]);
        ExpenseModel::destroy($request->id);
        return back()->with('success', 'Expense Deleted Successfully');
    }

    
}
