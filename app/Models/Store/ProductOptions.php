<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOptions extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'attribute','value','price'];

    public function prodcut()
    {
        return $this->belongsTo(Product::class);
    }
}
