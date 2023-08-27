<?php

namespace App\Http\Controllers\API\Store;

use App\Http\Controllers\Controller;
use App\Models\Store\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
       /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return response()->json(Category::whereNull('parent_id')->latest()->with(['all_children'])->get());
    }



}
