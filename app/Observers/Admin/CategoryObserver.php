<?php

namespace App\Observers\Admin;

use Illuminate\Support\Str;
use App\Models\Admin\Category;

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
