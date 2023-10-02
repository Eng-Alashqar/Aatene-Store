<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $filters = request()->query();
        $count = request()->query('count');
        $users = User::filters($filters)->latest()->paginate($count);
        return response()->json(['status' => (bool)$users, 'data' => $users], Response::HTTP_OK);
    }

}
