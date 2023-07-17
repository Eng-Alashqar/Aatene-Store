<?php

namespace App\Models;

use App\Traits\HasPhoto;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Seller extends User
{
    use HasFactory , Notifiable , HasApiTokens , HasPhoto;

    protected $fillable = [
        'name',
        'email',
        'password',
        'last_active_at',
        'status',
        'phone_number',
        'gold_coins',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
