<?php

namespace App\Services\Api\Chat;

use App\Http\Requests\Chat\MessageRequest;
use App\Models\Chat\Conversation;
use App\Models\Users\Admin;
use App\Models\Users\Seller;
use App\Models\Users\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class MessageService
{
    public function getMessagesByConversationIdAndCurrentAuthUser($id)
    {
        $user = Auth::user();
        $conversation = $user->conversations()->findOrFail($id);
        return  $conversation->message()->paginate();
    }

    public function dataValidation($request)
    {
        $validator = Validator::make($request->all(), (new MessageRequest())->rules());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }
        return  $validator->validated();
    }


    public function checkUserType($user_type)
    {
        $participant_type = get_class(new User);
        switch ($user_type) {
            case 'admin':
                $participant_type = get_class(new Admin);
                break;
            case 'seller':
                $participant_type = get_class(new Seller);
                break;
        }
        return $participant_type;
    }


    public function createMessage($data)
    {
        $user = Auth::user();
        $participant_id =  $data['participant_id'];
        $user_type =   $data['participant_type'];
        $participant_type = $this->checkUserType($user_type);
        $conversation_id = null;
        $conversation = null;
        if (array_key_exists('conversation_id', $data) &&  $conversation_id = $data['conversation_id'] != null) {
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
            'body' => $data['body'],
        ]);
        return $message;
    }
}
