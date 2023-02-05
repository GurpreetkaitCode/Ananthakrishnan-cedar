<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use PDO;
use phpDocumentor\Reflection\PseudoTypes\True_;
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
        $firstname = $reservation[0]->guest_first_name;
        $lastname = $reservation[0]->guest_last_name;
        $fullname = $firstname . ' ' . $lastname;
        $checkin = $reservation[0]->check_in;
        $checkout = $reservation[0]->check_out;
        $checkintime = $reservation[0]->check_in_time;
        $checkouttime = $reservation[0]->check_out_time;
        $room = $reservation[0]->room;
        $ch = curl_init('https://django-jwt-api.vercel.app/');
        curl_setopt_array($ch, array(
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => array(
                'email' => $email,
                'checkin' => $checkin . 'T' . $checkintime . 'Z',
                'checkout' => $checkout . 'T' . $checkouttime . 'Z',
                'room' => $room,
                'name' => $fullname
            ),
            CURLOPT_RETURNTRANSFER => 1
        ));
        $resp = curl_exec($ch);
        curl_close($ch);
        $responseArr = json_decode($resp, true);
        try {
            if (is_array($responseArr)) {
                $keyid = [];
                foreach ($responseArr as $resp) {
                    if (array_key_exists('error', $resp)) {
                        return back()->with('error', $resp['message'] . '-Upstream error');
                    }
                    foreach ($resp as $response) {
                        if ($response) {
                            if (array_key_exists('error', $response)) {
                                return back()->with('error', $response['error'] . '-Upstream error');
                            } else {
                                $keyid[] = $response['id'];
                                break;
                            }
                        }
                    }
                }
                $keyid = json_encode($keyid);
                try {
                    Reservation::where('id', $id)->update(['klevio_key' => '1', 'key_id' => $keyid]);
                    return back()->with('success', "Key has been enabled");
                } catch (Exception $e) {
                    return back()->with('error', $e->getMessage());
                }
            }
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function callDisableApi($id)
    {
        $reservation = Reservation::where('id', $id)->get();
        $keys = $reservation[0]->key_id;
        $ch = curl_init('https://django-jwt-api.vercel.app/delete');
        curl_setopt_array($ch, array(
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => array(
                'keys' => $keys
            ),
            CURLOPT_RETURNTRANSFER => 1
        ));
        $resp = curl_exec($ch);
        curl_close($ch);
        $responseArr = json_decode($resp, true);
        try {
            if (is_array($responseArr)) {
                foreach ($responseArr as $resp) {
                    if (is_array($resp)) {
                        if (array_key_exists('error', $resp)) {
                            return back()->with('error', $resp['message'] . '- Upstream error');
                        }
                    }
                    if ($resp == true) {
                        try {
                            Reservation::where('id', $id)->update(['klevio_key' => '0', 'key_id' => null]);
                            return back()->with('success', "Key has been disabled");
                        } catch (Exception $e) {
                            return back()->with('error', $e->getMessage());
                        }
                    } else {
                        return back()->with('error', $resp);
                    }
                }
            } else {
                return back()->with('error', 'Upstream error');
            }
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
