<?php
namespace App\Http\Controllers\Api\Auth\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\Api\User\UserResource;
use App\Models\Users\User;
use App\Services\Api\Auth\LoginService;
use App\Services\Api\Auth\RegisterService;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:user', ['except' => ['login', 'register']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        return  (new LoginService('user'))->login($request);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return (new LoginService('user'))->refresh();
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        return  (new RegisterService(new User,UserResource::class))->register($request->validated());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->guard('user')->logout();
        return response()->json(['message' => 'تسجيل خروج المستخدم بنجاح']);
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        return response()->json(auth('user')->user());
    }

}
