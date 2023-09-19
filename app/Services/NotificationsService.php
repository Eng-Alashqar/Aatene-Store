<?php

namespace App\Services;

use App\Models\Store\Product;
use App\Models\Users\User;
use App\Notifications\UserNotify;

class NotificationsService
{
    public function pushNotify( $id , $title  , $body)
    {

//
        $product = Product::find($id);

        $followingUsers = User::whereHas('following', function ($query) use ($product) {
            $query->where('store_id', $product->store->id);
        })->get();

        $tokens = $followingUsers->pluck('token_notify')->toArray();

//



        $SERVER_API_KEY = "AAAA7xWDcnc:APA91bHFRZq2KA9-SrLtctrqJnSNUmIqVKa6wxZ1DlG7mkse9J_ym064xcryjvn1--I1n8HyUA480SygPiroDLywAUX_usKeK77dPFPNvnGaDUDNfcJ7ed5mXINFyFhSTbi4kBd8WBLd	";

        $token_1 = 'ekeE2lmETB6X0OT_Y-KyJl:APA91bH4K4DwuS3qP0ezJz9xvnRiTE9jbHzwXZIjmp8iN6V3GzDtJjw6xVK4lENTPnO18K7vBaGnWf9ZjL0oXbzrkTLPCItIiKAWydm-QUUvLAB3uXZMxztz_E_ougPBljmB2vkTznaG';

        $data = [

            "registration_ids" => $tokens,

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

//        dd(json_decode($response)->success);



    }

    public function createNotficatoin($users , $product)
    {
        foreach ($users as $user){
            $user->notify(new UserNotify($product));
        }
    }

}
