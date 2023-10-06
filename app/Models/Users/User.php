<?php

namespace App\Models\Users;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Chat\Conversation;
use App\Models\Chat\Message;
use App\Models\Report;
use App\Models\Store\Favorite;
use App\Models\Profile;
use App\Models\Store\Order;
use App\Models\Store\Store;
use App\Traits\HasPhoto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasPhoto, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_active_at',
        'token_notify',
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
    ];

    public function initiatorConversations()
    {
        return $this->morphMany(Conversation::class, 'initiator');
    }

    public function ParticipantConversations()
    {
        return $this->morphMany(Conversation::class, 'participant');
    }

    public function getConversationsAttribute()
    {
        $conversations1 = $this->initiatorConversations;
        $conversations2 = $this->ParticipantConversations;
        $conversations = array($conversations1, $conversations2);
        return $conversations;
    }

    public function profile()
    {
        return $this->morphOne(Profile::class, 'userable');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function followers()
    {
        return $this->belongsToMany(Store::class, 'followers', 'user_id', 'store_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setToken($token)
    {
        $this->token_notify = $token;
        $saved = $this->save();
        return $saved;
    }

    public function ScopeFilters(Builder $builder, $filters)
    {
        $params = array_merge([
            'search' => null,
            'status' => null
        ], $filters);
        $builder->when($params['search'], function ($builder, $value) {
            $builder->where('name', 'like', "%$value%")
                ->orWhere('email', 'like', "%$value%")
                ->orWhere('phone_number', 'like', "%$value%");
        });
        $builder->when($params['status'], function ($builder, $value) {
            $builder->where('status', '=', $value);
        });
    }

    public function reports(){
        return $this->hasMany(Report::class);
    }


}
