<?php

namespace App\Observers\Store;

use App\Models\Store\Product;
use Illuminate\Support\Str;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function creating(Product $product): void
    {
        $product->store_id = auth()->guard('seller')->user()->store_id;
        $product->slug = Str::slug($product->name);
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updating(Product $product): void
    {
        $product->store_id = auth()->guard('seller')->user()->store_id;
        $product->slug = Str::slug($product->name);
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
