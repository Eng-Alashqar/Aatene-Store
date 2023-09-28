<?php

namespace App\Models;

use App\Models\Store\Product;
use App\Models\Store\Store;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function stores(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Store::class,'store_region','region_id','store_id','id','id');
    }

    public function shipping(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class,'shipping_region','region_id','product_id','id','id')->withPivot(['price']);
    }

    public function scopeFilter(Builder $builder,$filters)
    {
        $params = array_merge([
            'search'=>null,
        ],$filters);

        $builder->when($params['search'],function($builder , $value){
            $builder->where('name','like',"%$value%");
        });

        /*
        $builder->whereHas('regions',function($builder,$value){
            $builder->where('id',$value);
            });*/
    }
}
