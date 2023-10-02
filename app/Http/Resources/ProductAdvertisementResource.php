<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Advertisement\ProductAdvertisement */
class ProductAdvertisementResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'price' => $this->price,
            'total' => $this->total,
            'status' => $this->status,
            'product' => StoreResourse::make($this->product),
        ];
    }
}
