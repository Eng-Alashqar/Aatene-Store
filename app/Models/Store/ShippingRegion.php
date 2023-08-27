<?php

namespace App\Models\Store;

use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ShippingRegion extends Pivot
{
    use HasFactory;
    protected $table = 'shipping_region';
    public $timestamps = false;
    protected $primaryKey = ['product_id', 'region_id'];
    protected $fillable = ['product_id', 'region_id', 'price'];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'shipping_region', 'region_id', 'product_id', 'id', 'id')
        ->withPivot([
            'price'
        ]);
    }

    public function regions()
    {
        return $this->belongsToMany(Region::class, 'shipping_region', 'product_id', 'region_id', 'id', 'id')
        ->withPivot([
            'price'
        ]);
    }
}
