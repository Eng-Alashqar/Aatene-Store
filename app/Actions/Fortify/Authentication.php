<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Authentication
{
    public function login($request)
    {
        $email = $request->post('email');
        $password = $request->post('password');
        $user = User::where('email','=',$email)->first();
        if($user && Hash::check($password,$user->password)){
            return $user;
        }
        return false;
    }
}
