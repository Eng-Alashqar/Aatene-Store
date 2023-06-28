<?php

namespace App\Observers\Admin;

use App\Models\Store;
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

    /**
     * Handle the Store "restored" event.
     */
    public function restored(Store $store): void
    {
        //
    }

    /**
     * Handle the Store "force deleted" event.
     */
    public function forceDeleted(Store $store): void
    {
        //
    }
}
