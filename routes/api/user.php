<?php


use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\Store\CategoryController;
use App\Http\Controllers\Api\Store\FollowerController;
use App\Http\Controllers\Api\Store\StoreController;
use App\Http\Controllers\Api\Store\FavoriteController;
use App\Http\Controllers\Api\Users\NotificationController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:user')->prefix('user')->group(function () {


    Route::prefix('orders')->controller(OrderController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::get('/{id}', 'show');
    });

    Route::prefix('/favorites')->group(function () {
        Route::get('/', [FavoriteController::class, 'index']);
        Route::post('/', [FavoriteController::class, 'store']);
        Route::delete('/{favorite}', [FavoriteController::class, 'destroy']);
    });

    Route::post('store/{store}/follow', [FollowerController::class, 'follow'])->name('store.follow');
    Route::delete('store/{store}/unfollow', [FollowerController::class, 'unfollow'])->name('store.unfollow');



//    Route::apiResource('products', ProductController::class);
    Route::apiResource('stores', StoreController::class)->except('destroy');

//    http://127.0.0.1:8000/api/v1/user/user-noti
    Route::get("user-noti" , [NotificationController::class , 'userNotifications']);
    Route::get("user-noti" , [NotificationController::class , 'userNotifications']);


//    http://127.0.0.1:8000/api/v1/user/set-token
    Route::post('set-token', [NotificationController::class, 'setToken']);

    Route::get('followers', [FollowerController::class, 'followersListForUser']);

});


