<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/dashboard')->name('dashboard.')->middleware(['auth', 'user-type:super_administrator,customer'])->group(function () {
    Route::get('/', function () {
        return view('store.index');
    });
});
