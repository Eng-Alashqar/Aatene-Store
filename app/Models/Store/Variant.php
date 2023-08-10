<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsTo(Variant::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attributes_variants')
            ->withPivot(['value'])
            ->as('option');
    }
}
