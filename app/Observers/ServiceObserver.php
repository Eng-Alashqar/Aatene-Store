<?php

namespace App\Observers;

use App\Helpers\UniqueSlug;
use App\Models\MultimediaHub\Service;
use Illuminate\Support\Str;

class ServiceObserver
{
    /**
     * Handle the service "created" event.
     */
    public function creating(Service $service): void
    {
        $service->slug =UniqueSlug::generateUniqueSlug($service->name);
        $service->store_id = auth()->guard()->user()->store_id;

    }

    /**
     * Handle the service "updated" event.
     */
    public function updating(Service $service): void
    {
        $service->slug = UniqueSlug::generateUniqueSlug($service->name);
        $service->store_id = auth()->guard()->user()->store_id;

    }

    /**
     * Handle the service "deleted" event.
     */
    public function deleted(Service $service): void
    {
        //
    }

    /**
     * Handle the service "restored" event.
     */
    public function restored(Service $service): void
    {
        //
    }


}
