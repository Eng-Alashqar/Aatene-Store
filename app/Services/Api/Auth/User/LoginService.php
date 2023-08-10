<?php

namespace App\Services\Api\Auth\User;

use App\Http\Requests\Users\User\LoginRequest;
use App\Http\Resources\Api\User\UserResource;
use App\Models\Users\User;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class LoginService
{
    private $model;
    public function __construct()
    {
        $this->model  = new User;
    }

    public function createNewToken($token)
    {
        $user = auth()->guard('user_api')->user();
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl'),
            'user' => new UserResource($user)
                ]);
    }

    public function login($request)
    {
        $validator =  Validator::make($request->all(), (new LoginRequest())->rules());

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }
        $data = $validator->validated();

        if (!$token = auth()->guard('user_api')->attempt($data)) {
            return response()->json(['message' => 'Unauthorize'], Response::HTTP_UNAUTHORIZED);
        }
        return $this->createNewToken($token);
    }
}
