<?php

namespace Database\Seeders;

use App\Models\SettingModel;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = new SettingModel();
        $settings->url = 'http://localhost:8000';
        $settings->logo = 'logo.png';
        $settings->map = 'map/CedarHollowMap.jpg';
        $settings->calender =
        '<iframe
        src="https://calendar.google.com/calendar/b/2/embed?height=600&amp;wkst=1&amp;bgcolor=%23039BE5&amp;ctz=Europe%2FLondon&amp;src=ZW4udWsjaG9saWRheUBncm91cC52LmNhbGVuZGFyLmdvb2dsZS5jb20&amp;src=MXNqY3Exbjk0c3RoOWFnMWZuaTJpOWFoNmhlYjExOG5AaW1wb3J0LmNhbGVuZGFyLmdvb2dsZS5jb20&amp;color=%23A79B8E&amp;color=%23D50000&amp;showPrint=1&amp;title=Cedar%20Hollow%20Bookings"
        style="border-width: 0;"
        width="800"
        height="600"
        frameborder="0"
        scrolling="no"
      ></iframe>';
        $settings->save();
    }
}
