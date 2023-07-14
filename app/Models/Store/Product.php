<?php

namespace App\Models\Store;

use App\Models\Store;
use App\Traits\HasPhoto;
use App\Models\Admin\Category;
use App\Models\Scopes\StoreScope;
use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, HasPhoto;

    protected $fillable = [
        'store_id', 'category_id', 'name', 'slug', 'description',
        'featured','visits_count','is_available','quantity', 'price', 'compare_price', 'rating', 'status'
        ];

    public static function booted()
    {
        static::addGlobalScope('store' , new StoreScope());
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

