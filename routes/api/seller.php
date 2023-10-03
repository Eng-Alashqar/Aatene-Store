<?php

use App\Http\Controllers\Api\Advertisement\MainBannerAdsController;
use App\Http\Controllers\Api\Advertisement\ProductAdvertisementController;
use App\Http\Controllers\Api\Advertisement\ProductListController;
use App\Http\Controllers\Api\Advertisement\StoreAdvertisementController;
use App\Http\Controllers\Api\Advertisement\SubBannerAdsController;
use App\Http\Controllers\Api\Store\FollowerController;
use App\Http\Controllers\Store\StoreController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:seller')->prefix('seller')->group(function () {
//    Route::apiResource('products', ProductController::class);
    Route::apiResource('stores', StoreController::class);
    Route::get('followers', [FollowerController::class, 'followersList']);
    Route::apiResource('store-advertisements',StoreAdvertisementController::class);
    Route::apiResource('product-advertisements',ProductAdvertisementController::class);
    Route::apiResource('products-list-ads',ProductListController::class);
    Route::apiResource('main-banners',MainBannerAdsController::class);
    Route::apiResource('sub-banners',SubBannerAdsController::class);
});
