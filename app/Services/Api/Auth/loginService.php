<?php

namespace App\Services\Api\Auth;

use App\Http\Requests\Api\LoginRequest;
use App\Http\Resources\Api\Seller\SellerResource;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class LoginService
{

    private $guard;
    public function __construct($guard)
    {
        $this->guard  = $guard;
    }

    public function createNewToken($token)
    {
        $user = auth()->guard($this->guard)->user();
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 10000*9000000,
            'user' => ($user)
        ]);
    }


    public function login($request)
    {
        $validator =  Validator::make($request->all(), (new LoginRequest())->rules());

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }
        $data = $validator->validated();
        if (!$token = auth()->guard($this->guard)->attempt($data)) {
            return response()->json(['message' => 'Unauthorize'], Response::HTTP_UNAUTHORIZED);
        }
        return $this->createNewToken($token);
    }


    public function refresh() {
        return $this->createNewToken(auth()->guard($this->guard)->refresh());
    }



}
