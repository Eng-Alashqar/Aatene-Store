<?php

namespace App\Models\MultimediaHub;

use App\Helpers\UniqueSlug;
use App\Traits\HasPhoto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Topic extends Model
{
    use HasFactory,HasPhoto;

    protected $fillable = ['title', 'content', 'userable_id','userable_type'];

    public function userable()
    {
        return $this->morphTo();
    }
    public static function booted ()
    {
        static::creating(function (Topic $topic) {
            $topic->slug = Str::slug($topic->title).'-'.time();
        });
    }
}
