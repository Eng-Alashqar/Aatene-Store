<?php

namespace App\Http\Controllers\Api\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Services\Api\Auth\LoginService;
use Illuminate\Http\Request;


class AdminAuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        return (new LoginService('admin'))->login($request);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->guard('admin')->logout();
        return response()->json(['message' => 'تسجيل خروج المستخدم بنجاح']);
    }
}
