<?php


use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\Store\CategoryController;
use App\Http\Controllers\API\Store\FollowerController;
use App\Http\Controllers\API\Store\StoreController;
use App\Http\Controllers\API\Store\FavoriteController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:user')->prefix('user')->group(function () {

//
//    Route::prefix('orders')->group(function () {
//        Route::post('/', [OrderController::class, 'create']);
//        Route::put('/{id}', [OrderController::class, 'update']);
//        Route::get('/{id}', [OrderController::class, 'show']);
//    });

    Route::prefix('/favorites')->group(function () {
        Route::get('/', [FavoriteController::class, 'index']);
        Route::post('/', [FavoriteController::class, 'store']);
        Route::delete('/{favorite}', [FavoriteController::class, 'destroy']);
    });

    Route::post('store/{store}/follow', [FollowerController::class, 'follow'])->name('store.follow');
    Route::delete('store/{store}/unfollow', [FollowerController::class, 'unfollow'])->name('store.unfollow');



//    Route::apiResource('products', ProductController::class);
    Route::apiResource('stores', StoreController::class)->except('destroy');
});


