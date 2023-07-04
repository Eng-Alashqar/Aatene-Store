<?php

namespace App\Models;

use App\Models\Admin\Region;
use App\Observers\Admin\StoreObserver;
use App\Traits\HasPhoto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Store extends Model
{
    use HasFactory, HasPhoto;

    protected $fillable = ['name', 'slug', 'description', 'status', 'is_accepted', 'rating', 'level', 'user_id',];

    public static function  booted()
    {
        static::observe(StoreObserver::class);
    }
    public function scopeFilter(Builder $builder,$filters)
    {
        $params = array_merge([
            'search'=>null,
            'status'=>null,
            'level'=>null,

        ],$filters);

        $builder->when($params['search'],function($builder , $value){
            $builder->where('name','like',"%$value%");
        });

        $builder->when($params['status'],function($builder,$value){
            $builder->where('status','=',$value);
        });

        $builder->when($params['level'],function($builder,$value){
            $builder->where('level','=',$value);
        });
        /*
        $builder->whereHas('regions',function($builder,$value){
            $builder->where('id',$value);
            });*/
    }
    
    public function scopeActive(Builder $builder)
    {
        $builder->where('status', 'active')->where('is_accepted', true);
    }


    public function scopePending(Builder $builder)
    {
        $builder->where('is_accepted', false);
    }

    public function scopeAccepted(Builder $builder)
    {
        $builder->where('is_accepted', true);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function regions()
    {
        return $this->belongsToMany(Region::class, 'store_region', 'store_id', 'region_id', 'id', 'id');
    }

    public function getStatusArAttribute()
    {
        switch ($this->status) {
            case 'active':
                return 'متجر نشط';
                break;
            case 'blocked':
                return 'متجر محظور ';
                break;
            case 'inactive':
                return 'متجر في اجازة ';
                break;
        }
    }

    public function getStoreLevelAttribute()
    {
        switch ($this->level) {
            case 1:
                return 'برونزي';
                break;
            case 2:
                return 'فضي ';
                break;
            case 3:
                return 'ذهبي ';
                break;
            case 4:
                return 'الماسي ';
                break;
            case 5:
                return 'التاج ';
                break;
        }
    }
}
