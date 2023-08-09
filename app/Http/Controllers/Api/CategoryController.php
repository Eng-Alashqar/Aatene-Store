<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
