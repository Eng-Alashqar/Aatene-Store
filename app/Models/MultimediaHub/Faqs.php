<?php

namespace App\Models\MultimediaHub;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faqs extends Model
{
    use HasFactory;

    protected $fillable = ['question','answer'];


    public function scopeFilter(Builder $builder,$filters)
    {
        $params = array_merge([
            'search'=>null,
        ],$filters);

        $builder->when($params['search'],function($builder , $value){
            $builder->where('question','like',"%$value%")->orWhere('answer','like',"%$value%");
        });
    }

}
