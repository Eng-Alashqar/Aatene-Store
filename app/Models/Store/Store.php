<?php

namespace App\Models\Store;

use App\Models\Advertisement\StoreAdvertisement;
use App\Models\Loyalty\Follower;
use App\Models\Region;
use App\Models\Users\Seller;
use App\Observers\Store\StoreObserver;
use App\Traits\HasPhoto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Store extends Model
{
    use HasFactory, HasPhoto;

    protected $fillable = ['name', 'slug', 'location', 'description', 'status', 'is_accepted', 'rating', 'level', 'block_reason'];

    public static function  booted()
    {
        static::observe(StoreObserver::class);
    }
    public function scopeFilter(Builder $builder, $filters)
    {
        $params = array_merge([
            'search' => null,
            'status' => null,
            'level' => null,

        ], $filters);

        $builder->when($params['search'], function ($builder, $value) {
            $builder->where('name', 'like', "%$value%")->orWhere('description', 'like', "%$value%");
        });

        $builder->when($params['status'], function ($builder, $value) {
            $builder->where('status', '=', $value);
        });

        $builder->when($params['level'], function ($builder, $value) {
            $builder->where('level', '=', $value);
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


    public function seller(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Seller::class)->withDefault(['name' => 'لايوجد حاليا']);
    }

    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class, 'store_id', 'id');
    }

    public function regions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Region::class, 'store_region', 'store_id', 'region_id', 'id', 'id');
    }

    public function followers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Follower::class, 'store_id');
    }

    public function StoreAdvertisements(){
        return $this->hasMany(StoreAdvertisement::class);
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
