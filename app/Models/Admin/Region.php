<?php

namespace App\Models\Admin;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function stores()
    {
        return $this->belongsToMany(Store::class,'store_region','region_id','store_id','id','id');
    }
}
