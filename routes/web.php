<?php

use App\Http\Controllers\CostController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\KeysController;
use App\Http\Controllers\MonthlyDataController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TaxController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::get('/upload-data', function () {
        return view('admin.upload');
    })->name('upload');
    Route::controller(MonthlyDataController::class)->group(function () {
        Route::get('/monthly', 'show')->name('monthlydata');
        // Route::post('/upload-data', 'importExcel')->name('importExcel');
    });
    Route::controller(ImportController::class)->group(function () {
        Route::post('/upload-data', 'importExcel')->name('importExcelIcs');
    });
    Route::controller(RevenueController::class)->group(function () {
        Route::get('/revenue', 'show')->name('revenue');
    });
    Route::controller(TaxController::class)->group(function () {
        Route::get('/tax', 'show')->name('tax');
    });
    Route::controller(KeysController::class)->group(function () {
        Route::get('/keys', 'show')->name('keys');
    });
    Route::controller(CostController::class)->group(function () {
        Route::get('/costs', 'show')->name('costs');
        Route::post('/deletecost', 'deleteCost')->name('deleteCost');
    });
    Route::controller(SettingsController::class)->group(function () {
        Route::get('/calender', 'showCalender')->name('calender');
        Route::get('/map', 'showMap')->name('map');
    });
    Route::controller(ExpensesController::class)->group(function () {
        Route::post('/addexpensetype', 'addExpenseType')->name('addExpenseType');
        Route::post('/addexpense', 'addexpense')->name('addExpense');
        Route::get('/capitalexpenditure', 'showCapitalExpenditure')->name('showCapitalExpenditure');

    });

});
// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware(['auth'])->name('dashboard');;
// Route::get('/upload-data', function () {
//     return view('admin.upload');
// })->middleware(['auth'])->name('upload');
// Route::get('/monthly-data', function () {
//     return view('admin.monthlydata');
// })->middleware(['auth'])->name('monthlydata');
require __DIR__ . '/auth.php';
