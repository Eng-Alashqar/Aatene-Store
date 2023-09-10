<?php

namespace App\Models\MultimediaHub;

use App\Models\Store\Category;
use App\Models\Scopes\StoreScope;
use App\Models\Store\Store;
use App\Observers\ServiceObserver;
use App\Traits\HasPhoto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory,HasPhoto;

    protected $fillable = [
        'name', 'description', 'price', 'active',
        'duration', 'location', 'category_id', 'store_id'
    ];

    public static function booted()
    {
        static::addGlobalScope('store', new StoreScope());
        static::observe(ServiceObserver::class);
    }

    public function ScopeFilter(Builder $builder,$params){
        $filters = array_merge([
            'search' => null,
        ],$params);

        $builder->when($filters['search'],function ($builder,$value){
            $builder->where('name','like',"%$value%")
                ->orWhere('description','like',"%$value%")
                ->orWhere('price','like',"%$value%")
                ->orWhere('active','like',"%$value%")
                ->orWhere('duration','like',"%$value%")
                ->orWhere('location','like',"%$value%");
        });
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
