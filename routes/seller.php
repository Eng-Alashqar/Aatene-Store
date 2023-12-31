<?php

use App\Http\Controllers\Advertisement\MainBannerController;
use App\Http\Controllers\Advertisement\ProductAdvertisementController;
use App\Http\Controllers\Advertisement\ProductListController;
use App\Http\Controllers\Advertisement\StoreAdvertisementController;
use App\Http\Controllers\Advertisement\SubBannerController;
use App\Http\Controllers\MultimediaHub\BlogController;
use App\Http\Controllers\MultimediaHub\JobController;
use App\Http\Controllers\MultimediaHub\ServiceController;
use App\Http\Controllers\MultimediaHub\TopicController;
use App\Http\Controllers\Notification\SellerNotificationController;
use App\Http\Controllers\Store\ProductController;
use App\Http\Controllers\Store\ProfileController;
use App\Http\Controllers\Store\StoreSettingsController;
use Illuminate\Support\Facades\Route;


Route::prefix('/dashboard')->name('dashboard.')->middleware(['auth:seller'])->group(function () {
    Route::get('/home', function () {
        return view('store.index');
    })->name('home');
    Route::resource('products', ProductController::class);
    Route::get('products/variants', [ProductController::class,'variantsShow'])->name('variants');
    Route::post('products/images/upload', [ProductController::class,'upload'])->name('product_images');
    Route::post('products/images/delete', [ProductController::class,'deleteImage'])->name('product_images.delete');

    Route::prefix('/topics')->name('topics.')->group(function () {
        Route::get('/create', [TopicController::class, 'create'])->name('create');
        Route::post('', [TopicController::class, 'store'])->name('store');
    });

    Route::prefix('/profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/edit', [ProfileController::class, 'update'])->name('update');

    });

    Route::prefix('/store-settings')->name('store-settings.')->group(function () {
        Route::get('/edit', [StoreSettingsController::class, 'edit'])->name('edit');
        Route::put('/edit', [StoreSettingsController::class, 'update'])->name('update');
    });
//    Route::resource('profile',ProfileController::class);
    Route::resource('jobs', JobController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('blogs', BlogController::class);

    Route::get('orders', [App\Http\Controllers\Store\OrderController::class, 'index'])->name('orders.index');

    Route::resource('advertisements',StoreAdvertisementController::class);
    Route::resource('product-advertisements',ProductAdvertisementController::class);
    Route::resource('products-list',ProductListController::class);
    Route::resource('main-banners',MainBannerController::class);
    Route::resource('sub-banners',SubBannerController::class);




    Route::get("index-noti", [SellerNotificationController::class, 'index'])->name('index.noti');
    Route::get("create-noti", [SellerNotificationController::class , 'create'])->name('create.noti');
    Route::post('store-noti' , [SellerNotificationController::class , 'store'])->name('store.noti');
    Route::post('restore-noti/{id}' , [SellerNotificationController::class , 'restore'])->name('restore.noti');
    Route::post('delete-noti/{id}' , [SellerNotificationController::class , 'forceDelete'])->name('delete.noti');



});
