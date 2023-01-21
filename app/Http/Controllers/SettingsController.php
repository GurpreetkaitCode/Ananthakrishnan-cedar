<?php

namespace App\Http\Controllers;

use App\Models\SettingModel;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function showCalender()
    {
        $calender = SettingModel::select('calender')->get();
        return view('admin.calendar', compact('calender'));
    }

    public function showMap()
    {
        $map = SettingModel::select('map')->get();
        return view('admin.map', compact('map'));
    }
}
