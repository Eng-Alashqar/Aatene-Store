<?php

namespace App\Http\Controllers\Api\Users;

use App\Helpers\PhotoUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProfileRequest;
use App\Models\Users\User;
use Symfony\Component\HttpFoundation\Response;

class NotificationController extends Controller
{
    public function userNotifications()
    {

        $notificatoins =   auth()->guard('user')->user()->unreadNotifications()->get() ;

        if ($notificatoins){
        return \response()->json(['data'=>$notificatoins , 'status' => 200 ] , '200');
        }
        return \response()->json(['data'=>'no data found' , 'status' => 200 ] , '200');
    }

}
