<?php

use App\Http\Controllers\Shared\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('/dashboard')->name('dashboard.')->group(function () {
    Route::get('/', function () {
        return view('store.index');
    });

    Route::resource('products', ProductController::class);
});
