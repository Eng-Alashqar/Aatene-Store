<?php

namespace App\Models;

use App\Observers\Admin\StoreObserver;
use App\Traits\HasPhoto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory, HasPhoto;

    protected $fillable = ['name', 'slug', 'description', 'status'];

    public static function  booted()
    {
        static::observe(StoreObserver::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(['name' => 'لايوجد مالك حاليا']);
    }

    public function getStatusArAttribute()
    {
        switch ($this->status) {
            case 'active':
                return 'متجر فعال';
                break;
            case 'pending':
                return 'متجر معلق ';
                break;
                case 'inactive':
                    return 'متجر مغلق ';
                    break;
            }
    }
}
