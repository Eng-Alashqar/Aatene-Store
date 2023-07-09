<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CateogryResourse;
use App\Models\Admin\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //
        $categories = Category::all();

        if (!$categories) {
            return ApiResponse::sendResponse(200, 'Categories Not Found', []);
        }

        return ApiResponse::sendResponse(200, 'Categories Retrieved Successfully', CateogryResourse::collection($categories));
    }
}
