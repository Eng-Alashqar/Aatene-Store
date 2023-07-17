<?php

use App\Http\Controllers\Shared\JobController;
use App\Http\Controllers\Shared\ProductController;
use App\Http\Controllers\Shared\TopicController;
use Illuminate\Support\Facades\Route;


Route::prefix('/dashboard')->name('dashboard.')->middleware(['auth:seller'])->group(function () {
    Route::get('/', function () {
        return view('store.index');
    })->name('home');

    Route::resource('products', ProductController::class);

    Route::prefix('/topics')->name('topics.')->group(function () {
        Route::get('/create', [TopicController::class, 'create'])->name('create');
        Route::post('', [TopicController::class, 'store'])->name('store');
    });

    Route::resource('jobs', JobController::class);
});
