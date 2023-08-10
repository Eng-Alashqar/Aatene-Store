<?php

use App\Http\Controllers\Store\CategoryController;
use App\Http\Controllers\Store\FaqsController;
use App\Http\Controllers\Store\RegionController;
use App\Http\Controllers\Store\StoreController;
use App\Http\Controllers\Users\AdminController;
use App\Http\Controllers\Users\RoleController;
use Illuminate\Support\Facades\Route;


Route::prefix('/administrator')->name('admin.')->middleware(['auth:admin'])->group(function(){
    Route::get('/home',function(){
        return view('admin.index');
        })->name('home');
    Route::resource('stores',StoreController::class);
    Route::get('stores-pending',[StoreController::class,'pending'])->name('stores.pending');
    Route::post('stores-accept/{id}',[StoreController::class,'accept'])->name('stores.accept');
    Route::resource('categories',CategoryController::class);
    Route::resource('users',StoreController::class);
    Route::resource('regions',RegionController::class);
    Route::resource('roles',RoleController::class);
    Route::resource('permissions',RegionController::class);
    Route::resource('faqs',FaqsController::class);
    Route::resource('admins',AdminController::class);
});
