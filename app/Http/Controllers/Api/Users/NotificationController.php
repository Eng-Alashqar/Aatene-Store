<?php

namespace App\Http\Controllers\Api\Users;

use App\Helpers\PhotoUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProfileRequest;
use App\Models\Users\User;
use Dotenv\Validator;
use Illuminate\Support\Facades\Request;
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

    public function setToken(Request $request)
    {
        $validator = validator($request->all() , [
           'token'=> 'required'
        ]);
        if ($validator->fails()){
            return response()->json(['data'=>$validator->getMessageBag()] , 401);
        }else{
             $saved = auth()->guard('user')->user()->setToken($request->token);
             if ($saved){
                 return response()->json(['data'=> ['message' => 'success generate token'] , 201]);
             }else{
                 return response()->json(['data'=> ['message' => 'failed generate token'] , 400]);
             }
        }
    }

}
