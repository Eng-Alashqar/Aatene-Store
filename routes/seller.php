<?php

use App\Http\Controllers\Shared\BlogController;
use App\Http\Controllers\Shared\JobController;
use App\Http\Controllers\Shared\ProductController;
use App\Http\Controllers\Shared\ServiceController;
use App\Http\Controllers\Shared\TopicController;
use Illuminate\Support\Facades\Route;


Route::prefix('/dashboard')->name('dashboard.')->middleware(['auth:seller'])->group(function () {
    Route::get('/home', function () {
        return view('store.index');
    })->name('home');
    Route::resource('products', ProductController::class);
    Route::post('products/images/upload', [ProductController::class,'upload'])->name('product_images');
    Route::prefix('/topics')->name('topics.')->group(function () {
        Route::get('/create', [TopicController::class, 'create'])->name('create');
        Route::post('', [TopicController::class, 'store'])->name('store');
    });
    Route::resource('jobs', JobController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('blogs', BlogController::class);

    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');

});
