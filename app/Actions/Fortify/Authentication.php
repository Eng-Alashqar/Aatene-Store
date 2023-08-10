<?php

namespace App\Actions\Fortify;

use App\Models\Users\Admin;
use App\Models\Users\Seller;
use App\Models\Users\User;
use Illuminate\Support\Facades\Hash;

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
