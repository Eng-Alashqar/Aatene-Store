<?php

use App\Http\Controllers\Advertisement\PriceController;
use App\Http\Controllers\Advertisement\ProductAdvertisementController;
use App\Http\Controllers\Advertisement\StoreAdvertisementController;
use App\Http\Controllers\Chat\ConversationController;
use App\Http\Controllers\Store\CategoryController;
use App\Http\Controllers\Store\FaqsController;
use App\Http\Controllers\Store\ProductController;
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
    Route::resource('advertisements',StoreAdvertisementController::class);
    Route::resource('product-advertisements',ProductAdvertisementController::class);
    Route::get('advertisements-orders',[StoreAdvertisementController::class,'indexOrder'])->name('advertisements-orders');
    Route::get('product-advertisements-orders',[ProductAdvertisementController::class,'indexOrder'])->name('product-advertisements-orders');
    Route::post('store-advertisements-accept/{id}',[StoreAdvertisementController::class,'orderAccepted'])->name('advertisement-store.accept');
    Route::post('product-advertisements-accept/{id}',[ProductAdvertisementController::class,'orderAccepted'])->name('product-advertisement.accept');
    Route::resource('prices',PriceController::class);
    Route::get('chat',[ConversationController::class,'index'])->name('chat.index');
    Route::post('chat/search',[ConversationController::class,'search'])->name('chat.search');
    Route::get('chat/show/{id}',[ConversationController::class,'show'])->name('chat.show');
});
