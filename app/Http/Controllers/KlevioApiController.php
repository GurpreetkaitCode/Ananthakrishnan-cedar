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
    public function success($msg = null){
        return json_encode(['success' => true , 'message' => $msg]);
    }
    public function error($msg = null){
        return json_encode(['error' => true, 'message' => $msg]);
    }
    public function callApi($id)
    {
        $reservation = Reservation::where('id', $id)->first();
        $email = $reservation->email;
        $firstname = $reservation->guest_first_name;
        $lastname = $reservation->guest_last_name;
        $fullname = $firstname . ' ' . $lastname;
        $checkin = date('Y-m-d',strtotime($reservation->check_in));
        $checkout = date('Y-m-d',strtotime($reservation->check_out));
        $checkintime = $reservation->check_in_time;
        $checkouttime = $reservation->check_out_time;
        if(empty($checkintime) || empty($checkouttime)){
            return $this->error('Checkin or Checkout time is empty');
        }
        $room = $reservation->room;
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
                        // return back()->with('error', $resp['message'] . '-Upstream error');
                       return $this->error($resp['message'] . '-Upstream error');
                    }
                    foreach ($resp as $response) {
                        if ($response) {
                            if (array_key_exists('error', $response)) {
                                // return back()->with('error', $response['error'] . '-Upstream error');
                                return $this->error($response['error'] . '-Upstream error');
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
                    // return back()->with('success', "Key has been enabled");
                    return $this->success("Key has been enabled");
                } catch (Exception $e) {
                    return $this->error($e->getMessage());
                    // return back()->with('error', $e->getMessage());
                }
            }
        } catch (Exception $e) {
            // return back()->with('error', $e->getMessage());
            return $this->error($e->getMessage());
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
                            // return back()->with('error', $resp['message'] . '- Upstream error');
                            return $this->error($resp['message'] . '- Upstream error');
                        }
                    }
                    if ($resp == true) {
                        try {
                            Reservation::where('id', $id)->update(['klevio_key' => '0', 'key_id' => null]);
                            // return back()->with('success', "Key has been disabled");
                            return $this->success("Key has been disabled");
                        } catch (Exception $e) {
                            // return back()->with('error', $e->getMessage());
                            return $this->error($e->getMessage());
                        }
                    } else {
                        // return back()->with('error', $resp);
                        return $this->error($resp);
                    }
                }
            } else {
                // return back()->with('error', 'Upstream error');
                return $this->error('Upstream error');
            }
        } catch (Exception $e) {
            // return back()->with('error', $e->getMessage());
            return $this->error($e->getMessage());
        }
    }
}
