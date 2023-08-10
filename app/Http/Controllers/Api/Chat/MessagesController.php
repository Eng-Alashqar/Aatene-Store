<?php

namespace App\Http\Controllers\Api\Chat;

use App\Events\Chat\MessageCreated;
use App\Http\Controllers\Controller;
use App\Models\Chat\Participant;
use App\Services\Api\Chat\MessageService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MessagesController extends Controller
{
    private $service;
    public function __construct()
    {
        $this->service = new MessageService();
    }
    public function index($id)
    {
        return response()->json(['conversations' => $this->service->getMessagesByConversationIdAndCurrentAuthUser($id)], Response::HTTP_OK);
    }


    public function store(Request $request)
    {
        $data = $this->service->dataValidation($request);
        $message = $this->service->createMessage($data);
        broadcast(new MessageCreated($message));
        return response()->json(['message' => $message], Response::HTTP_OK);
    }
}
