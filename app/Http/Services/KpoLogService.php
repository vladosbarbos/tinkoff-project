<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class KpoLogService
{

    public static function log($action, $from, $to, $error = null)
    {
        $response = Http::post('http://51.250.38.164:23052/callback', [
            'action' => $action,
            'from' => $from,
            'over' => 'UI',
            'to' => $to,
            'timestamp' => date(DATE_ATOM, time())
        ]);

        return $response;
    }

    public static function sendWebHook($text)
    {
        $curl = curl_init();

        $post_fields = [
            "key" => "joDcQSCinGjBKi0BjOpPnmRI2249y5Lf0rTWnsJa",
            "secret" => "tN4NZHFxAqKOTkalIJeNRB1ADHVCTWJ4", //Demo secret, get yours at https://piesocket.com
            "roomId" => "1",
            "message" => $text
        ];
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://s8145.nyc1.piesocket.com/api/publish",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($post_fields),
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        print_r($response);
    }

}
