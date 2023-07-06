<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResourse;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $stores = Store::all();

        if (!$stores) {
            return ApiResponse::sendResponse(200, 'Stores Not Found', []);
        }

        return ApiResponse::sendResponse(200, 'Stores Retrieved Successfully', StoreResourse::collection($stores));
    }
}
