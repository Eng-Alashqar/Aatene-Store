<?php

use App\Http\Controllers\Api\Auth\Admin\AdminAuthController as AdminAuthController;
use App\Http\Controllers\Api\Auth\Seller\AuthController;
use App\Http\Controllers\Api\Auth\User\AuthController as UserAuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->prefix('auth')->group(function () {
    Route::controller(UserAuthController::class)->prefix('user')->group(function () {
        Route::post('/login', 'login');
        Route::post('/register', 'register');
        Route::post('/logout', 'logout');
        Route::post('/refresh', 'refresh');
    });

    Route::controller(AuthController::class)->prefix('seller')->group(function () {
        Route::post('/login', 'login');
        Route::post('/register', 'register');
        Route::post('/logout', 'logout');
        Route::post('/refresh', 'refresh');
    });

    Route::controller(AdminAuthController::class)->prefix('admin')->group(function () {
        Route::post('/login', 'login');
        Route::post('/refresh', 'refresh');
        Route::post('/logout', 'logout');
    });
});


