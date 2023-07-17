<?php

namespace App\Models;

use App\Traits\HasPhoto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Admin extends User
{
    use HasFactory,HasApiTokens,HasPhoto,HasRoles;

    public function scopeExceptAuthUser(Builder $builder)
    {
        $id = request()->user()->id;
        $builder->where('id','<>', $id);
    }

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

    public function getStatusArAttribute()
    {
        switch ($this->status) {
            case 'active':
                return 'مستخدم نشط';
                break;
            case 'blocked':
                return 'مستخدم محظور ';
                break;
            case 'inactive':
                return 'مستخدم في اجازة ';
                break;
        }
    }
}
