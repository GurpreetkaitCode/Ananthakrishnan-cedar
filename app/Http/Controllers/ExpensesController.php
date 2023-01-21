<?php

namespace App\Http\Controllers;

use App\Models\ExpenseModel;
use App\Models\ExpensesCategoryModel;
use App\Models\ExpenseTypeModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpensesController extends Controller
{
    public function addExpenseType(Request $request)
    {

        request()->validate([
            'type' => 'required',
            'category_id' => 'required',
        ]);

        $expense = new ExpenseTypeModel();
        $expense->type = $request->type;
        $expense->category_id = $request->category_id;
        $expense->save();
        return back()->with('success', 'Expense Type Added Successfully');
    }

    public function addExpense(Request $request)
    {
        request()->validate([
            'amount' => 'required',
            'expense_relation_id' => 'required',
            'receipt' => 'required',
            'year' => 'required',
            'month' => 'required',
        ]);
        $expenseIds = $request->expense_relation_id;
        $ids = explode('__', $expenseIds);
        $expenseTypeId = $ids[0];
        $expensecategoryId = $ids[1];
        $image = $request->file('receipt');
        $path = $image->store('receipts');
        $createDate = $request->year . '-' . $request->month . '-01';
        $expenses = new ExpenseModel();
        $expenses->amount = $request->amount;
        $expenses->expense_id = $expenseTypeId;
        $expenses->expensecategory_id = $expensecategoryId;
        $expenses->receipt = $path;
        $expenses->date = $createDate;
        $expenses->save();
        return back()->with('success', 'Expense Added Successfully');
    }

    public function showCapitalExpenditure(Request $request)
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
            $expenses = ExpenseModel::where('expensecategory_id', 2)->whereBetween('date', [$from, $to])->with('getExpenseType')->get();
            $fromyear = $request->fromyear;
            $frommonth = $request->frommonth;
            $toyear = $request->toyear;
            $tomonth = $request->tomonth;
        } else {
            $expenses = ExpenseModel::where('expensecategory_id', 2)->with('getExpenseType')->get();
        }
        return view('admin.capitalexpenditure', compact('costCategories', 'expensestypes', 'expenses', 'fromyear', 'frommonth', 'toyear', 'tomonth'));
    }
}
