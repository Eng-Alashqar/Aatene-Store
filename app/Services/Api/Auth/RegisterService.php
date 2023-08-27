<?php

namespace App\Services\Api\Auth;


use Illuminate\Support\Facades\Hash;
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

    public function register($params): \Illuminate\Http\JsonResponse
    {

        $params['password'] = Hash::make($params['password']);
        $user =  $this->model->create($params);
        return response()->json([
            'message' => 'تم اضافة المستخدم بنجاح',
            "user"=> new $this->resource($user)
        ], Response::HTTP_CREATED);
    }
}

