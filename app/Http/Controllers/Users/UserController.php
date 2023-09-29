<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $filters = request()->query();
        $count = (int)request()->query('count');
        $users = User::filters($filters)->latest()->paginate($count == 0 ? 7 : $count);
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'status' => ['required', 'in:active,blocked'],
            'password' => ['nullable', 'string', new Password, 'confirmed'],
        ]);
        $params = $request->only(['status']);
        if (isset($params['password'])) {
            $params['password'] = Hash::make($params['password']);
        } else {
            unset($params['password']);
        }
        $user->update($params);

        return to_route('admin.users.index')->with(['notification' => 'تم التعديل بنجاح']);
    }

    public function destroy(User $user)
    {
        $isDeleted = $user->delete();
        return $this->deleteAjaxResponse($isDeleted);
    }
}
