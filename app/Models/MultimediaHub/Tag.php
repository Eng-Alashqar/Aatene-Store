<?php

namespace App\Models\MultimediaHub;

use App\Models\Store\Product;
use App\Observers\Store\TagObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Tag extends Model
{
    use HasFactory;

    public static function booted()
    {
        static::observe(TagObserver::class);
    }

    public $timestamps = false;

    protected $fillable = ['name', 'slug'];

    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_tag', 'tag_id', 'product_id', 'id', 'id');
    }

    public function ScopeFilterApi(Builder $builder, $filters)
    {
        $params = array_merge([
            'tag_id' => null,
            'product_id' => null
        ], $filters);

        $builder->when($params['tag_id'], function ($builder, $value) {
            $builder->whereRaw('id IN (SELECT product_id FROM product_tag Where tag_id = ? )', [$value]);
        });

        $builder->when($params['product_id'], function ($builder, $value) {
            $builder->whereRaw('id IN (SELECT tag_id FROM product_tag Where product_id = ? )', [$value]);
        });

        //dosenot work return error
        /*
            $builder->whereExists(function($query) use($value){
                $query->select(1)
                ->from('product_tag')
                ->whereRaw('product_id = products.id')
                ->where('tag_id','=',$value);
            });
        */
        // $builder->whereRaw('EXISTS (SELECT 1 FROM product_tag WHERE tag_id =? AND product_id = products.id )',[$value]);

        /*
            $builder->whereHas('tags',function($builder) use($value){
            $builder->where('id',$value);
            });
        */

    }


}
