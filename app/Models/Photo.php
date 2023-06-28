<?php

namespace App\Models;

use App\Observers\PhotoObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['src','type','slug'];

    protected static function booted()
    {
        static::observe(PhotoObserver::class);
    }

    public function photoable()
    {
        return $this->morphTo();
    }
}
