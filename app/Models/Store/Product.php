<?php

namespace App\Models\Store;

use App\Models\Scopes\StoreScope;
use App\Models\Store\Comment;
use App\Models\Store\Product\Order;
use App\Models\Store\Rating;
use App\Models\Store\Tag;
use App\Observers\Store\ProductObserver;
use App\Traits\HasPhoto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

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
        return $this->belongsTo(Store::class, 'store_id', 'id');
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

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

