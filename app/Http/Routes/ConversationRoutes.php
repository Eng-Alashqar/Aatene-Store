<?php
namespace App\Http\Routes;

use App\Http\Controllers\Api\Chat\ConversationController;
use App\Http\Controllers\Api\Chat\MessagesController;
use Illuminate\Support\Facades\Route;

class ConversationRoutes
{
    public static function defineRoutes()
    {
        Route::get('conversations', [ConversationController::class, 'index']);
        Route::get('conversations/{conversation}', [ConversationController::class, 'show']);
        Route::get('conversations/{id}/messages', [MessagesController::class, 'index']);
        Route::post('messages', [MessagesController::class, 'store']);
    }
}
