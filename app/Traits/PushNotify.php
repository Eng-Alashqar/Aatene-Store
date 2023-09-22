<?php

namespace App\Traits;

trait PushNotify
{
    public function pushNotify(array $tokens , $title  , $body)
    {


        $SERVER_API_KEY = "AAAAs_lttBc:APA91bFDXUSmPptSPVzUj4CbeCDSiDHSBvw1DJGgOsWh3XysFZpBEFFHDkh4sCYncoror7OPlH160RFtUYJ9ldFtJg1533HtfOxqfREGPphRrKIExA5O-PtNLCqRo5wrRvhvJvE3sttz";

        $token_1 = 'ekeE2lmETB6X0OT_Y-KyJl:APA91bH4K4DwuS3qP0ezJz9xvnRiTE9jbHzwXZIjmp8iN6V3GzDtJjw6xVK4lENTPnO18K7vBaGnWf9ZjL0oXbzrkTLPCItIiKAWydm-QUUvLAB3uXZMxztz_E_ougPBljmB2vkTznaG';

        $data = [

            "registration_ids" => [$tokens[0] , $tokens[1]],

            "notification" => [

                "title" => $title,

                "body" =>  $body,

//            "sound"=> "default" // required for sound on ios

            ],

        ];

        $dataString = json_encode($data);

        $headers = [

            'Authorization: key=' . $SERVER_API_KEY,

            'Content-Type: application/json',

        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
//    curl_setopt($ch, CURLOPT_URL, 'POST https://fcm.googleapis.com/v1/projects/laranotipush/messages:send');

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        dd(json_decode($response)->success);



    }
}
