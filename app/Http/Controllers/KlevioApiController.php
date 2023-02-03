<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use PSpell\Dictionary;

class KlevioApiController extends Controller
{

    public function __construct()
    {
    }
    public function callApi($id)
    {
        $reservation = Reservation::where('id', $id)->get();
        $email = $reservation[0]->email;
        $checkin = $reservation[0]->check_in;
        $checkin  = str_replace('-', '', $checkin);
        $checkout = $reservation[0]->check_out;
        $checkout = str_replace('-', '', $checkout);
        $checkintime = $reservation[0]->check_in_time;
        $checkouttime = $reservation[0]->check_out_time;
        $room = $reservation[0]->room;
        // dd($checkin . 'T' . $checkintime . 'Z', $checkout . 'T' . $checkouttime . 'Z');
        $ch = curl_init('https://django-jwt-api.vercel.app/');
        // $ch = curl_init('http://localhost:8000/');
        curl_setopt_array($ch, array(
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => array(
                'email' => $email,
                'checkin' => $checkin . 'T' . $checkintime . 'Z',
                'checkout' => $checkout . 'T' . $checkouttime . 'Z',
                'room' => $room
            ),
            CURLOPT_RETURNTRANSFER => 1
        ));
        $resp = curl_exec($ch);
        curl_close($ch);
        $resp = json_decode($resp, true);
        if (is_array($resp) || $resp) {
            foreach ($resp as $response) {
                if (array_key_exists('error', $response)) {
                    return back()->with('error', $response['error'] . '-Upstream error');
                }
            }
            try {
                Reservation::where('id', $id)->update(['klevio_key' => '1']);
            } catch (Exception $e) {
                return back()->with('error', $e->getMessage());
            }
            return back()->with('success', "Key has been enabled");
        }
    }
}
