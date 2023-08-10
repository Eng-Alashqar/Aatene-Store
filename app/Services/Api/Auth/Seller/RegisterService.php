<?php

namespace App\Services\Api\Auth\Seller;

use App\Http\Requests\Seller\RegisterRequest;
use App\Http\Resources\Api\Seller\SellerResource;
use App\Models\Users\Seller;
use App\Services\Store\StoreService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class RegisterService
{
    private $model;
    public function __construct()
    {
        $this->model  = new Seller();
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
            "user"=> new SellerResource($user)
        ], Response::HTTP_OK);
    }

    public function createStore($request)
    {
        return (new StoreService())->store($request);
    }
}

