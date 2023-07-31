<?php

use App\Http\Controllers\Api\Chat\ConversationController;
use App\Http\Controllers\Api\Chat\MessagesController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:user_api')->prefix('user')->group(function () {
    Route::apiResource('products', ProductController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('stores', StoreController::class);

});
