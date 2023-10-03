<?php

use App\Http\Controllers\Advertisement\MainBannerController;
use App\Http\Controllers\Advertisement\PriceController;
use App\Http\Controllers\Advertisement\ProductAdvertisementController;
use App\Http\Controllers\Advertisement\ProductListController;
use App\Http\Controllers\Advertisement\StoreAdvertisementController;
use App\Http\Controllers\Chat\ConversationController;
use App\Http\Controllers\Notification\AdminNotifyController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\Store\CategoryController;
use App\Http\Controllers\Store\FaqsController;
use App\Http\Controllers\Store\ProductController;
use App\Http\Controllers\Store\RegionController;
use App\Http\Controllers\Store\StoreController;
use App\Http\Controllers\Users\AdminController;
use App\Http\Controllers\Users\RoleController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Configration\SettingsController;
use App\Http\Controllers\Notification\NotificationController;


Route::prefix('/administrator')->name('admin.')->middleware(['auth:admin'])->group(function(){
    Route::get('/home',function(){
        return view('admin.index');
        })->name('home');
    Route::resource('stores',StoreController::class);
    Route::get('stores-pending',[StoreController::class,'pending'])->name('stores.pending');
    Route::post('stores-accept/{id}',[StoreController::class,'accept'])->name('stores.accept');
    Route::resource('categories',CategoryController::class);
    Route::resource('users',UserController::class);
    Route::resource('regions',RegionController::class);
    Route::resource('roles',RoleController::class);
    Route::resource('permissions',RegionController::class);
    Route::resource('faqs',FaqsController::class);
    Route::resource('admins',AdminController::class);

    Route::resource('advertisements',StoreAdvertisementController::class);
    Route::post('store-advertisements-accept/{id}',[StoreAdvertisementController::class,'orderAccepted'])->name('advertisement-store.accept');
    Route::get('advertisements-orders',[StoreAdvertisementController::class,'indexOrder'])->name('advertisements-orders');

    Route::resource('product-advertisements',ProductAdvertisementController::class);
    Route::get('product-advertisements-orders',[ProductAdvertisementController::class,'indexOrder'])->name('product-advertisements-orders');
    Route::post('product-advertisements-accept/{id}',[ProductAdvertisementController::class,'orderAccepted'])->name('product-advertisement.accept');

    Route::resource('prices',PriceController::class);

    Route::resource('products-list',ProductListController::class);
    Route::post('products-list-accept/{id}',[ProductListController::class,'orderAccepted'])->name('products-list.accept');
    Route::get('products-list-orders',[ProductListController::class,'indexOrder'])->name('products-list-orders');

    Route::resource('main-banners',MainBannerController::class);
    Route::post('main-banner-accept/{id}',[MainBannerController::class,'orderAccepted'])->name('main-banner.accept');
    Route::get('main-banner-orders',[MainBannerController::class,'indexOrder'])->name('main-banner-orders');
//    Route::post('main-banner/images/upload', [MainBannerController::class,'uploadImages'])->name('main-banner_images');
//    Route::post('main-banner/images/delete', [MainBannerController::class,'deleteImage'])->name('main-banner_images.delete');



    Route::get('chat',[ConversationController::class,'index'])->name('chat.index');
    Route::post('chat/search',[ConversationController::class,'search'])->name('chat.search');
    Route::get('chat/show/{id}',[ConversationController::class,'show'])->name('chat.show');

    Route::get("notification/{type?}" , [AdminNotifyController::class , 'index'])->name('notification');
    Route::post("notification/mark-all-read" , [AdminNotifyController::class , 'markAllAsRead'])->name('notification.mark.all.read');
    Route::post("notification/mark-read{id}" , [AdminNotifyController::class , 'markAsRead'])->name('notification.mark.read');




    Route::get("index-noti", [NotificationController::class, 'index'])->name('index.noti');
    Route::get("create-noti", [NotificationController::class , 'create'])->name('create.noti');
    Route::post('store-noti' , [NotificationController::class , 'store'])->name('store.noti');
    Route::post('restore-noti/{id}' , [NotificationController::class , 'restore'])->name('restore.noti');
    Route::post('delete-noti/{id}' , [NotificationController::class , 'forceDelete'])->name('delete.noti');
    Route::prefix('settings')->controller(SettingsController::class)->name('settings.')->group(function (){
        Route::get('/','index')->name('index');
    });
});

