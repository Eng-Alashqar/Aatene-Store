<?php

namespace App\Observers;

use App\Models\MultimediaHub\Service;
use Illuminate\Support\Str;

class ServiceObserver
{
    /**
     * Handle the service "created" event.
     */
    public function creating(Service $service): void
    {
        $service->slug = Str::slug($service->name);
    }

    /**
     * Handle the service "updated" event.
     */
    public function updating(Service $service): void
    {
        $service->slug = Str::slug($service->name);
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
