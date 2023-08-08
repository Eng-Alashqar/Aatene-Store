<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\FavoriteController;
use App\Http\Controllers\API\FollowerController;
use App\Http\Controllers\Api\ProductController;


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

Route::middleware(['api', 'check_password','auth:user'])->group(function () {
    Route::apiResource('/products', ProductController::class);
    Route::get('/categories', [CategoryController::class,'index']);

    Route::prefix('/favorites')->group(function () {
        Route::get('/', [FavoriteController::class, 'index']);
        Route::post('/', [FavoriteController::class, 'store']);
        Route::delete('/{favorite}', [FavoriteController::class, 'destroy']);
    });

    Route::post('store/{store}/follow', [FollowerController::class, 'follow'])->name('store.follow');
    Route::delete('store/{store}/unfollow', [FollowerController::class, 'unfollow'])->name('store.unfollow');
});


require __DIR__.'/api/auth.php';
require __DIR__.'/api/seller.php';
require __DIR__.'/api/user.php';
require __DIR__.'/api/chat.php';




