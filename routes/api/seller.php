<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:seller_api')->prefix('seller')->group(function () {
    Route::apiResource('products', ProductController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('stores', StoreController::class);
});
