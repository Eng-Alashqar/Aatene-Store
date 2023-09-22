<?php

namespace App\Traits;

use Vonage\Client;
use Vonage\SMS\Message\SMS;
use Vonage\Client\Credentials\Basic;

trait SendSms
{
    public function CreateSmsNotify( $phone , $message , $client)
    {

//        $basic  = new Basic( getenv("SMS_KET"), getenv("SMS_SECRET"));
//        $client = new Client($basic);


        $response = $client->sms()->send(
            new SMS("$phone", getenv('SMS_BRAND'), $message)
        );

        $message = $response->current();

        if ($message->getStatus() == 0) {
            return response()->json(['msg' => 'Message created product sent successfully'] , '200') ;
        } else {
            return response()->json(['msg' => 'Message created product failed to send'] , '400') ;
        }
    }
}
