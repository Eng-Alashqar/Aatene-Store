<?php

namespace App\Http\Controllers\Configration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
   public function index()
   {
       return view('admin.settings.index');
   }
}