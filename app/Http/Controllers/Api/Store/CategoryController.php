<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Store\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
       /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return response()->json(CategoryResource::collection(Category::all()));
    }

}
