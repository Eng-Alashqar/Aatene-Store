<?php

namespace App\Http\Controllers\Api\Chat;

use App\Events\Chat\MessageCreated;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Chat\Conversation;
use App\Models\Chat\Participant;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class MessagesController extends Controller
{
    public function index($id)
    {
        $user = Auth::user();
        $conversation = $user->conversations()->findOrFail($id);
        return response()->json(['conversations' => $conversation->message()->paginate()], Response::HTTP_OK);
    }


    public function store(Request $request)
    {
        $request->validate([
            'body' => ['required', 'string'],
            'conversation_id' => ['nullable', 'int', 'exists:conversations,id'],
            'participant_id' => ['required_without:conversation_id', 'nullable', 'int'],
            'participant_type' => ['required_with:participant_id', 'string', 'in:admin,seller,user'],
        ]);
        $user = Auth::user();
        $participant_id =  $request->post('participant_id');
        $user_type =  $request->post('participant_type');
        $participant_type = get_class(new User);
        switch ($user_type) {
            case 'admin':
                $participant_type = get_class(new Admin);
                break;
            case 'seller':
                $participant_type = get_class(new Seller);
                break;
        }
        $conversation_id = $request->post('conversation_id');
        $conversation = null;
        if ($conversation_id) {
            $conversation = $user->conversations()->find($conversation_id);
        } else {
            $conversation = Conversation::getConversationByParticipantAndInitiator($participant_id, $participant_type, $user)->first();
        }

        if (!$conversation_id && !$conversation) {
            $conversation = Conversation::create([
                'initiator_id' => $user->id,
                'initiator_type' => get_class($user),
                'participant_id' => $participant_id,
                'participant_type' => $participant_type,
            ]);
        }

        $message = $conversation->messages()->create([
            'sender_id' => $user->id,
            'sender_type' => get_class($user),
            'body' => $request->body
        ]);

        broadcast(new MessageCreated($message));
        return response()->json(['message' => $message], Response::HTTP_OK);
    }
}
