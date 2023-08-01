<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $hidden =
    [
        'userable_type',
        'userable_id'
    ];

    protected $fillable = ['first_name','last_name','birthday','gender','street_address','city','state','postal_code','country','locale',
    ];

    public function userable()
    {
        return $this->morphTo();
    }
}
