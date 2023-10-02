<?php

namespace App\Models\Advertisement;

use App\Models\Store\Category;
use Illuminate\Database\Eloquent\Model;

class ProductListAds extends Model
{
    protected $fillable = [
        'category_id',
        'start_at',
        'end_at',
        'price',
        'total',
        'status',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
