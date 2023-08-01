<?php

use App\Http\Controllers\Auth\Admin\AdminAuthController;
use App\Http\Controllers\Auth\Seller\SellerAuthController;
use App\Http\Controllers\Auth\User\UserAuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->prefix('auth')->group(function () {
    Route::controller(UserAuthController::class)->prefix('user')->group(function () {
        Route::post('/login',  'login');
        Route::post('/register',  'register');
        Route::post('/logout',  'logout');
        Route::get('/user-profile',  'userProfile');
    });

    Route::controller(SellerAuthController::class)->prefix('seller')->group(function () {
        Route::post('/login',  'login');
        Route::post('/register',  'register');
        Route::post('/logout',  'logout');
        Route::get('/user-profile',  'userProfile');
    });

    Route::controller(AdminAuthController::class)->prefix('admin')->group(function () {
        Route::post('/login',  'login');
        Route::post('/logout',  'logout');
    });
});


