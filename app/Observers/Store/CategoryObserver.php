<?php

namespace App\Observers\Store;

use App\Models\Store\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
     /**
     * Handle the Category "created" event.
     */
    public function creating(Category $category): void
    {
        $category->slug = Str::slug($category->name,'-','ar');
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
        $category->slug = Str::slug($category->name,'-','ar');
    }
}
