<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Store\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $products = Product::all();

        if (!$products) {
            return ApiResponse::sendResponse(200, 'Products Not Found', []);
        }

        return ApiResponse::sendResponse(200, 'Products Retrieved Successfully', ProductResource::collection($products));
    }
}
