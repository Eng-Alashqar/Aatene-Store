<?php

namespace App\Models\Store;

use App\Traits\HasPhoto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory, HasPhoto;

    protected $fillable = ['name','price','product_id', 'is_available'];

    public function products()
    {
        return $this->belongsTo(Variant::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attributes_variants');
    }
}
