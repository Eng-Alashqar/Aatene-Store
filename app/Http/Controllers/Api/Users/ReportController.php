<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function store(Request $request){

        $validator = validator($request->all() , [
            'report_message'=> 'string'
        ]);
        if ($validator->fails()){
            return response()->json(['data'=>$validator->getMessageBag()] , 401);
        }else{
            $user_id = auth()->guard('user')->user()->id ;
            $saved = auth()->guard('user')->user()->setToken($request->token);
            if ($saved){
                return response()->json(['data'=> ['message' => 'success generate token'] , 201]);
            }else{
                return response()->json(['data'=> ['message' => 'failed generate token'] , 400]);
            }
        }
    }
}
