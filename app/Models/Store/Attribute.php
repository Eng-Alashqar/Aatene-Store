<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    public $timestamps = false;

    public function variants()
    {
        return $this->belongsToMany(Variant::class, 'attributes_variants');
    }
}
