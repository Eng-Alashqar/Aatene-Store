<?php

namespace App\Models\MultimediaHub;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'user_id'];

    public static function booted ()
    {
        static::creating(function (Topic $topic) {
            $topic->slug = Str::slug($topic->title).'-'.time();
        });
    }
}
