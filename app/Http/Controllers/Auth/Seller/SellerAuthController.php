<?php
namespace App\Http\Controllers\Auth\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\StoreService;
use App\Services\Api\Auth\Seller\LoginService;
use App\Services\Api\Auth\Seller\RegisterService;



class SellerAuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(private StoreService $storeService) {
        $this->middleware('auth:seller_api', ['except' => ['login', 'register']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        return  (new LoginService())->login($request);
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        return  (new RegisterService())->register($request);
    }

    /**
     * Create Store .
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createStore(Request $request)
    {
        return  (new RegisterService())->register($request);
    }
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function singOut()
    {
        auth()->guard('seller_api')->logout();
        return response()->json(['message' => 'تسجيل خروج المستخدم بنجاح']);
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        return response()->json(auth('seller_api')->user()->profile);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userStore()
    {
        return response()->json(auth('seller_api')->user()->store);
    }
}
