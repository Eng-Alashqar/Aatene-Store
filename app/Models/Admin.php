<?php

namespace App\Models;

use App\Traits\HasPhoto;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Admin extends User
{
    use HasFactory,HasApiTokens,HasPhoto,HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'super_admin',
        'role_name',
        'last_active_at',
        'status',
        'phone_number',
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
        'role_name'=>'array',
    ];


}
