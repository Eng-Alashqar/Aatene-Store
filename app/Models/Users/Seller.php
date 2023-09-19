<?php

namespace App\Models\Users;

use App\Models\Chat\Conversation;
use App\Models\Message;
use App\Models\Store\Store;
use App\Models\Profile;
use App\Traits\HasPhoto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Seller extends User implements JWTSubject
{
    use HasFactory , Notifiable , HasApiTokens , HasPhoto;




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


    // public function receivedMessages()
    // {
    //     return $this->morphToMany(Message::class,'userable','recipients');
    // }

    protected $fillable = [
        'name',
        'email',
        'password',
        'last_active_at',
        'status',
        'phone_number',
        'gold_coins',
        'store_id'
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
        return $this->belongsTo(Store::class)->withDefault(['name'=>'لا يوجد حاليا']);
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
