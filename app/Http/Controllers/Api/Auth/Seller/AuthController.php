<?php

namespace App\Http\Controllers\Api\Auth\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\Api\Seller\SellerResource;
use App\Models\Users\Seller;
use App\Services\Api\Auth\LoginService;
use App\Services\Api\Auth\RegisterService;
use App\Services\Store\StoreService;
use Illuminate\Http\JsonResponse;
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
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        return (new LoginService('seller'))->login($request);
    }
    /**
     * Register a User.
     *
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        return (new RegisterService(new Seller,SellerResource::class))->register($request->validated());
    }
    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->guard('seller')->logout();
        return response()->json(['message' => 'تسجيل خروج المستخدم بنجاح']);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return (new LoginService('seller'))->refresh();
    }


}
