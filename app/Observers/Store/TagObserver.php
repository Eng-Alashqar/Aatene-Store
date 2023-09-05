<?php

namespace App\Observers\Store;

use App\Helpers\UniqueSlug;
use App\Models\MultimediaHub\Tag;

class TagObserver
{
    /**
     * Handle the Store "created" event.
     */
    public function creating(Tag $tag): void
    {
        $tag->slug =  UniqueSlug::generateUniqueSlug($tag->name);
    }

    /**
     * Handle the Store "updated" event.
     */
    public function updated(Tag $tag): void
    {
        $tag->slug =  UniqueSlug::generateUniqueSlug($tag->name);
    }


}
