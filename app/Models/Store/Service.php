<?php

namespace App\Models\Store;

use App\Models\Admin\Category;
use App\Models\Scopes\StoreScope;
use App\Observers\ServiceObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'active',
        'duration', 'location', 'category_id', 'store_id'
    ];

    public static function booted()
    {
        static::addGlobalScope('store', new StoreScope());
        static::observe(ServiceObserver::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
