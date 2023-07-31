<?php

namespace App\Http\Controllers\Api\Chat;

use App\Http\Controllers\Controller;
use App\Models\Chat\Conversation;
use App\Models\Chat\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ConversationController extends Controller
{
    public function index(){
        $user = Auth::user();
        return response()->json(['conversations'=>$user->conversations],Response::HTTP_OK);
    }

    public function show($id)
    {
        $conversation = Conversation::findOrFail($id);
        return response()->json(['conversation'=>$conversation->messages],Response::HTTP_OK);
    }

}
