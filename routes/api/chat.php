<?php

use App\Http\Controllers\Api\Chat\ConversationController;
use App\Http\Controllers\Api\Chat\MessagesController;
use App\Http\Routes\ConversationRoutes;
use Illuminate\Support\Facades\Route;

Route::prefix('chat/user')->middleware('auth:user')->group(function () {
    ConversationRoutes::defineRoutes();
});

Route::prefix('chat/seller')->middleware(['auth:seller'])->group(function () {
    ConversationRoutes::defineRoutes();
});

Route::prefix('chat/admin')->middleware('auth:admin')->group(function () {
    ConversationRoutes::defineRoutes();
});
