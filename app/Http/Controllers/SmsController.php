<?php

namespace App\Http\Controllers;

use App\Jobs\AdminSendSms;
use Illuminate\Http\Request;
use Vonage\Client\Credentials\Basic;
use Vonage\SMS\Message\SMS;
use Vonage\Client;


class SmsController extends Controller
{
    public function sendSms(Request $request)
    {

        $request->validate([
            'message'=> 'required|min:10|max:500'
        ]);

        try {
        dispatch(new AdminSendSms($request->message));
            return redirect()->back()->with('message' ,'تمت العملية بنجاح');

        }catch (\Throwable $ex){
            return redirect()->back()->with('message' ,'لم تتم العملية بنجاح');
        }
    }

    public function sms()
    {
        $current = 'ارسال رسائل (sms) للتجار';
        return view('admin.notifications.send-sms' , compact('current'));
    }


    public function push(){

    }
}
