<?php

use App\Http\Controllers\API\FavoriteController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\Store\StoreController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:user_api')->prefix('user')->group(function () {

    Route::apiResource('profiles', ProfileController::class);

    Route::prefix('orders')->group(function () {
        Route::post('/', [OrderController::class, 'create']);
        Route::put('/{id}', [OrderController::class, 'update']);
        Route::get('/{id}', [OrderController::class, 'show']);
    });

    Route::prefix('/favorites')->group(function () {
        Route::get('/', [FavoriteController::class, 'index']);
        Route::post('/', [FavoriteController::class, 'store']);
        Route::delete('/{favorite}', [FavoriteController::class, 'destroy']);
    });
    Route::apiResource('products', ProductController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('stores', StoreController::class);

});
