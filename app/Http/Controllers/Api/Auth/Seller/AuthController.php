<?php

namespace App\Http\Controllers\Api\Auth\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\Api\Seller\SellerResource;
use App\Models\Users\Seller;
use App\Services\Api\Auth\LoginService;
use App\Services\Api\Auth\RegisterService;
use App\Services\Store\StoreService;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(private StoreService $storeService)
    {
        $this->middleware('auth:seller', ['except' => ['login', 'register']]);
    }


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        return (new LoginService('seller'))->login($request);
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        return (new RegisterService(new Seller,SellerResource::class))->register($request->validated());
    }
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->guard('seller')->logout();
        return response()->json(['message' => 'تسجيل خروج المستخدم بنجاح']);
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        return response()->json(auth('seller')->user());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userStore()
    {
        return response()->json(auth('seller')->user()->store);
    }
}
