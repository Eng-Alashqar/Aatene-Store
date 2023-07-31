<?php

namespace App\Http\Controllers\API\Auth;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;        

class SellerAuthController extends Controller
{
    public function register(Request $request)
    {
        $seller = app(CreateNewUser::class)->create($request->only(['name', 'email', 'password']));
        auth('seller')->login($seller);

        $token = auth('seller')->login($seller);

    }
}
