<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Models\Chat\Conversation;
use App\Models\Users\Admin;
use App\Models\Users\Seller;
use App\Models\Users\User;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index()
    {
        $users = User::all();
        $admins = Admin::all();
        $sellers = Seller::all();
        return view('admin.chat.index', compact('users', 'admins', 'sellers'));
    }

    public function search()
    {
        $request = request();
        $id = $request->user_id;

        switch ($request->type) {
            case 'seller':
                $user = Seller::findOrFail($id);
                break;
            case 'admin':
                $user = Admin::findOrFail($id);

                break;
            default:
                $user = User::findOrFail($id);
                break;
        }

        $conversations = ($user->conversations);
        $users = User::all();
        $admins = Admin::all();
        $sellers = Seller::all();
        return view('admin.chat.index', compact('users', 'admins', 'sellers','conversations','user'));
    }

    public function show($id)
    {
        $conversation = Conversation::findOrFail($id);

        return view('admin.chat.show',compact('conversation'));
    }
}
