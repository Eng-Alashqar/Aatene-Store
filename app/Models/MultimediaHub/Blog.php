<?php

namespace App\Models\MultimediaHub;

use App\Traits\HasPhoto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory, HasPhoto;
    protected  $fillable = ['title','content','is_published','user_id'];

    public function ScopeFilter(Builder $builder,$params){
        $filters = array_merge([
            'search' => null,
        ],$params);

        $builder->when($filters['search'],function ($builder,$value){
            $builder->where('title','like',"%$value%")
                ->orWhere('content','like',"%$value%");
        });
    }
}
