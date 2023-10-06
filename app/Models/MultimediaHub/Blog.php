<?php

namespace App\Models\MultimediaHub;

use App\Observers\Store\BlogObserver;
use App\Models\Report;
use App\Traits\HasPhoto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory, HasPhoto;

    protected $fillable = ['title', 'content', 'is_published', 'store_id','slug'];

    public static function booted()
    {
        static::observe(BlogObserver::class);
        parent::booted(); // TODO: Change the autogenerated stub
    }

    public function ScopeFilter(Builder $builder, $params)
    {
        $filters = array_merge([
            'search' => null,
        ], $params);

        $builder->when($filters['search'], function ($builder, $value) {
            $builder->where('title', 'like', "%$value%")
                ->orWhere('content', 'like', "%$value%");
        });
    }

    public function reports()
    {
        $this->morphMany(Report::class , 'reportable');
    }

    public function report()
    {
        $this->morphOne(Report::class , 'reportable');
    }

}
