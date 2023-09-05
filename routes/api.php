<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\FavoriteController;
use App\Http\Controllers\API\FollowerController;
use App\Http\Controllers\API\Store\ProductController;
use App\Http\Controllers\API\Store\StoreController;
use App\Http\Controllers\Api\Store\TagsController;
use App\Http\Controllers\Api\Store\VariantsController;
use App\Http\Controllers\Api\Users\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Route::middleware(['api', 'check_password','auth:user'])->group(function () {
//
///*
//    Route::prefix('/favorites')->group(function () {
//        Route::get('/', [FavoriteController::class, 'index']);
//        Route::post('/', [FavoriteController::class, 'store']);
//        Route::delete('/{favorite}', [FavoriteController::class, 'destroy']);
//    });*/

//    /*
//    Route::post('orders/{product}', [OrderController::class, 'store']);
//    Route::delete('orders/{order}', [OrderController::class, 'destroy']);
//    Route::get('orders/{order}', [OrderController::class, 'show']);
//    Route::get('orders', [OrderController::class, 'index']);
//*/
////    Route::post('/products/{product}/report', [ProductController::class, 'reportProduct']);
////    Route::post('/stores/{store}/report', [StoreController::class, 'reportStore']);
//
////    Route::apiResource('profiles', ProfileController::class);
//
//});

Route::middleware(['api'])->group(function () {
    Route::apiResource('stores', StoreController::class)->middleware('auth:seller');
    Route::apiResource('/products', ProductController::class)->middleware('auth:seller');
    Route::get('/categories', [CategoryController::class, 'index']);

    Route::prefix('/profile')->middleware('auth:seller,user,admin')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'show');
        Route::post('/create', 'store');
        Route::put('/update', 'update');
        Route::delete('/delete', 'destroy');
    });

    Route::apiResource('/variants', VariantsController::class)->middleware('auth:seller');
    Route::apiResource('/tags', TagsController::class)->middleware('auth:seller');

});


require __DIR__ . '/api/auth.php';
require __DIR__ . '/api/seller.php';
require __DIR__ . '/api/user.php';
require __DIR__ . '/api/chat.php';




