<?php

namespace App\Models\Admin;

use App\Traits\HasPhoto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Observers\Admin\CategoryObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, HasPhoto;

    protected $fillable = ['name','slug','description','parent_id','status'];

    public static function booted()
    {
        static::observe(CategoryObserver::class);
    }

    public function scopeFilter(Builder $builder,$filters)
    {
        $params = array_merge([
            'search'=>null,
            'status'=>null
        ],$filters);

        $builder->when($params['search'],function($builder , $value){
            $builder->where('name','like',"%$value%");
        });

        $builder->when($params['status'],function($builder,$value){
            $builder->where('status','=',$value);
        });

        /*
        $builder->whereHas('regions',function($builder,$value){
            $builder->where('id',$value);
            });*/
    }

    public function scopeActive(Builder $builder)
    {
        $builder->where('status', 'active');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id')->withDefault(['name'=>'لا يوجد']);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Products::class);
    }

    public function ancestors()
    {
        return $this->parent()->with('ancestors');
    }


    public function getStatusArAttribute()
    {
        switch($this->status){
        case 'active':
            return 'قسم نشط';
            break;
        case 'archive':
            return 'قسم مؤرشف';
            break;
        }
    }
}
