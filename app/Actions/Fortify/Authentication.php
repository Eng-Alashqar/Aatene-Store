<?php

namespace App\Actions\Fortify;

use App\Models\Admin;
use App\Models\Seller;
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
        switch(config('fortify.guard')){
            case 'admin':
                $user = Admin::where('email','=',$email)->first();
            break;
            case 'seller':
                $user = Seller::where('email','=',$email)->first();
            break;
            default:
                $user = User::where('email','=',$email)->first();

        }
        if($user && Hash::check($password,$user->password)){
            return $user;
        }
        return false;
    }
}
