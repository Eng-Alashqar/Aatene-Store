<?php

namespace App\Models;

use App\Traits\HasPhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seller extends User implements JWTSubject
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

      /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }


    public function profile()
    {
        return $this->morphOne(Profile::class,'userable');
    }

}
