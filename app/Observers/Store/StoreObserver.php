<?php

namespace App\Observers\Store;

use App\Models\Store\Store;
use Illuminate\Support\Str;

class StoreObserver
{
    /**
     * Handle the Store "created" event.
     */
    public function creating(Store $store): void
    {
        $store->slug = Str::slug($store->name,'-','ar');
    }

    /**
     * Handle the Store "updated" event.
     */
    public function updated(Store $store): void
    {
        $store->slug = Str::slug($store->name,'-','ar');
    }

    /**
     * Handle the Store "deleted" event.
     */
    public function deleted(Store $store): void
    {
        //
    }

}
