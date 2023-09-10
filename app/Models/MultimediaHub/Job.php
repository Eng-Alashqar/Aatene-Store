<?php

namespace App\Models\MultimediaHub;

use App\Traits\HasPhoto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory,HasPhoto;

    protected $fillable = ['title', 'description', 'location', 'salary', 'company', 'type', 'place', 'deadline'];

    public function ScopeFilter(Builder $builder,$params){
        $filters = array_merge([
            'search' => null,
        ],$params);

        $builder->when($filters['search'],function ($builder,$value){
            $builder->where('title','like',"%$value%")
                ->orWhere('description','like',"%$value%")
                ->orWhere('location','like',"%$value%")
                ->orWhere('salary','like',"%$value%")
                ->orWhere('company','like',"%$value%")
                ->orWhere('type','like',"%$value%")
                ->orWhere('place','like',"%$value%")
                ->orWhere('deadline','like',"%$value%");

        });
    }
}
