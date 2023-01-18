<?php

use App\Http\Controllers\ImportController;
use App\Http\Controllers\MonthlyDataController;
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
