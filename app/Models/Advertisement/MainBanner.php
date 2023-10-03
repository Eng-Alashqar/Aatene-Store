<?php

namespace App\Models\Advertisement;

use App\Models\Store\Store;
use Illuminate\Database\Eloquent\Model;

class MainBanner extends Model
{
    protected $fillable = [
        'store_id',
        'start_at',
        'end_at',
        'price',
        'total',
        'status',
        'image',
    ];
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
