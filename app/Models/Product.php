<?php

namespace App\Models;

use App\Models\Admin\Category;
use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'price', 'quantity', 'is_available', 'release_date', 'status', 'category_id'
    ];

    public static function booted()
    {
        static::observe(ProductObserver::class);
    }
    
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id')
        ->withDefault();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id', 'id', 'id');
    }

    public function ratings() : MorphMany
    {
        return $this->morphMany(Rating::class, 'rateable');
    }

    public function variants() : HasMany
    {
        return $this->hasMany(Variant::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

