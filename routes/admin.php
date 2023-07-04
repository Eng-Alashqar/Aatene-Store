<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\StoreController;
use Illuminate\Support\Facades\Route;


Route::prefix('/administrator')->name('admin.')->middleware(['auth','user-type:store_manager,customer'])->group(function(){
    Route::get('/',function(){
        return view('admin.index');
        })->name('home');
    Route::resource('stores',StoreController::class);
    Route::get('stores-pending',[StoreController::class,'pending'])->name('stores.pending');
    Route::post('stores-accept/{id}',[StoreController::class,'accept'])->name('stores.accept');
    Route::resource('categories',CategoryController::class);
    Route::resource('users',StoreController::class);
    Route::resource('regions',StoreController::class);

});
