<?php

namespace App\Models\Admin;

use App\Models\Store;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Region extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function stores()
    {
        return $this->belongsToMany(Store::class,'store_region','region_id','store_id','id','id');
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
