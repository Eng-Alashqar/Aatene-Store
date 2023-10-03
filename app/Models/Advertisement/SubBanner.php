<?php

namespace App\Models\Advertisement;

use App\Models\Store\Store;
use Illuminate\Database\Eloquent\Model;

class SubBanner extends Model
{
    protected $fillable = [
        'store_id',
        'start_at',
        'end_at',
        'status',
        'image',
        'price',
        'total',
    ];

    protected $casts = [
        'image' => 'array',
    ];

    public function store(){
        return $this->belongsTo(Store::class);
    }
}
