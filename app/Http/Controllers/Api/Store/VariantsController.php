<?php

namespace App\Http\Controllers\Api\Store;

use App\Http\Controllers\Controller;
use App\Models\Store\Attribute;
use App\Models\Store\Variant;
use Illuminate\Http\Request;

class VariantsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:seller')->except('index');
    }


    public function index()
    {
        return Variant::with('attributes')->paginate();
    }


}
