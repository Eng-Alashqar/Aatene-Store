<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/*
Route::get('/dashboard', function () {
    return view('admin.index');
//    return User::create([
//         'name'=>'mohammad',
//         'email'=>'alashqar2002@gmail.com',
//         'password'=>Hash::make('password'),
//         'status'=>'active',
//         'user_type'=>'super_administrator',
//         'last_active_at'=>now(),
//     ]);

})->middleware('auth');
*/

require __DIR__.'/admin.php';
require __DIR__.'/store.php';
