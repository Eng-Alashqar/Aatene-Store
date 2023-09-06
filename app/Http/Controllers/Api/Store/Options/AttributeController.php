<?php

namespace App\Http\Controllers\Api\Store\Options;

use App\Http\Controllers\Controller;
use App\Models\Store\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index()
    {
        return Attribute::all();
    }
}
