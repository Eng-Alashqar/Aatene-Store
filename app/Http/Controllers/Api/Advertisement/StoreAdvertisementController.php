<?php

namespace App\Http\Controllers\Api\Advertisement;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\StoreAdvertisementResource;
use App\Models\Advertisement\Price;
use App\Models\Advertisement\StoreAdvertisement;
use App\Models\Store\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class StoreAdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $store_advertisement = StoreAdvertisement::query()->latest()->get();

        return sendResponse(true, 'success',StoreAdvertisementResource::collection($store_advertisement));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $roles = [
            'store_id' => 'required|int|exists:stores,id',
            'start_at' => 'required|date',
            'end_at' => 'required|date',
        ];
        $data = $request->only(['store_id', 'start_at', 'end_at']);
        $validator = Validator::make($data, $roles);
        if (!$validator->fails()) {
            $price = Price::query()->where('ad_type', '=', 'store')->first();
            $data['price'] = $price->amount;
            $store_advertisement = StoreAdvertisement::query()->create($data)->latest()->first();
            if ($store_advertisement) {
                return sendResponse(true, 'تم انشاء اعلان للمتجر بنجاح',StoreAdvertisementResource::make($store_advertisement));
            } else {
                return sendResponse(false, 'فشل انشاء اعلان للمتجر ! ');
            }
        } else {
            return sendResponse(false, $validator->getMessageBag()->first());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
