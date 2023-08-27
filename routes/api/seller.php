<?php

use App\Http\Controllers\Store\StoreController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:seller')->prefix('seller')->group(function () {
//    Route::apiResource('products', ProductController::class);
    Route::apiResource('stores', StoreController::class);
    Route::get('followers', [\App\Http\Controllers\API\Store\FollowerController::class, 'followersList']);

});
