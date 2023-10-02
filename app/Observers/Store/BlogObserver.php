<?php

namespace App\Observers\Store;

use App\Helpers\UniqueSlug;
use App\Models\MultimediaHub\Blog;

class BlogObserver
{
    /**
     * Handle the Store "created" event.
     */
    public function creating(Blog $blog): void
    {
        $blog->store_id = auth()->guard('seller')->user()->store_id;
        $blog->slug = UniqueSlug::generateUniqueSlug($blog->title);
    }

    /**
     * Handle the Store "updated" event.
     */
    public function updated(Blog $blog): void
    {
        $blog->slug = UniqueSlug::generateUniqueSlug($blog->title);
    }
}
