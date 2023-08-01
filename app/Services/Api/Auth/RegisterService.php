<?php

namespace App\Services\Api\Auth;

use App\Http\Requests\Api\RegisterRequest;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class RegisterService
{
    private $model;
    private $resource;
    public function __construct($model,$resource)
    {
        $this->model  = $model;
        $this->resource  = $resource;
    }

    public function register($request)
    {
        $validator =  Validator::make($request->all(), (new RegisterRequest())->rules());
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }
        $params = $validator->validated();
        $params['name'] = ($params['first_name'].' '.$params['last_name']);
        $params['password'] = Hash::make($params['password']);
        $user =  $this->model->create($params);
        $user->profile()->create($params);
        return response()->json([
            'message' => 'تم اضافة المستخدم بنجاح',
            "user"=> new $this->resource($user)
        ], Response::HTTP_OK);
    }
}

