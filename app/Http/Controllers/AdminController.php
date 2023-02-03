<?php

namespace App\Http\Controllers;

use App\Models\SettingModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\IcalendarGenerator\Components\Calendar;

class AdminController extends Controller
{
    public function show()
    {
        $settings = SettingModel::where('id', 1)->get();
        return view('admin.settings', compact('settings'));
    }
    public function update(Request $request)
    {
        $request->validate([

            'email' => 'required|email',
            'name' => 'required',

        ]);
        try {
            $settings = SettingModel::find(1);
            $user = User::find($request->id);
            if ($request->name) {
                $user->username = $request->name;
            }
            if ($request->email) {
                $user->email = $request->email;
            }
            if (!empty($request->password)) {
                $user->password = password_hash($request->password, PASSWORD_BCRYPT);
            }
            if ($request->calender || $request->hasFile('map_image') || $request->check_in_time || $request->check_out_time) {
                if ($request->check_in_time) {
                    $settings->check_in_time = $request->check_in_time;
                }
                if ($request->check_out_time) {
                    $settings->check_out_time = $request->check_out_time;
                }
                $settings->calender = $request->calender;
                if ($request->hasFile('map_image')) {
                    $file = $request->file('map_image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move(public_path('uploads/map/'), $filename);
                    $settings->map = $filename;
                }
                $settings->save();
            }
            $user->save();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
        return back()->with('success', 'Settings updated successfully');
    }
}
