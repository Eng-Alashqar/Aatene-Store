<?php

namespace App\Models\Store;

use App\Models\Admin\Products;
use App\Observers\Store\CategoryObserver;
use App\Traits\HasPhoto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static whereNull(string $string)
 */
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

    public function ancestors()
    {
        return $this->parent()->with('children');
    }
    public function all_children()
    {
        return $this->children()->with('children');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
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
