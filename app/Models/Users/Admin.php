<?php

namespace App\Models\Users;

use App\Models\Chat\Conversation;
use App\Models\Chat\Message;
use App\Traits\HasPhoto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends User implements JWTSubject
{
    use HasFactory, HasApiTokens, HasPhoto, HasRoles;

    public function initiatorConversations()
    {
        return $this->morphMany(Conversation::class,'initiator');
    }

    public function ParticipantConversations()
    {
        return $this->morphMany(Conversation::class,'participant');
    }


    public function getConversationsAttribute(){
        $conversations1 = $this->initiatorConversations;
        $conversations2 = $this->ParticipantConversations;
        $conversations = array($conversations1,$conversations2);
        return $conversations;
    }

    public function sentMessages()
    {
        $this->morphedByMany(Message::class,'userable');
    }

    public function scopeExceptAuthUser(Builder $builder)
    {
        $id = request()->user()->id;
        $builder->where('id', '<>', $id);
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
        'role_name' => 'array',
    ];

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
