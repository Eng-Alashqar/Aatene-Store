<?php

namespace App\Models\Chat;

use App\Models\Chat\Participant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'initiator_id',
        'initiator_type',
        'participant_id',
        'participant_type',
        'last_message_id',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class, 'conversation_id', 'id');
    }

    function ScopeGetConversationByParticipantAndInitiator(Builder $builder, $participantId, $participantType, $user)
    {
        return $builder->where(function ($query) use ($participantId, $participantType, $user) {
            $query->where(function ($subQuery) use ($participantId, $participantType) {
                $subQuery->where('participant_id', $participantId)
                    ->where('participant_type', $participantType);
            })->where(function ($subQuery) use ($user) {
                $subQuery->where('initiator_id', $user->id)
                    ->where('initiator_type', get_class($user));
            });
        })->orWhere(function ($query) use ($participantId, $participantType, $user) {
            $query->where(function ($subQuery) use ($participantId, $participantType) {
                $subQuery->where('initiator_id', $participantId)
                    ->where('initiator_type', $participantType);
            })->where(function ($subQuery) use ($user) {
                $subQuery->where('participant_id', $user->id)
                    ->where('participant_type', get_class($user));
            });
        });
    }

    public function user1()
    {
        return $this->morphTo('participant');
    }

    public function user2()
    {
        return $this->morphTo('initiator');
    }

    public function getParticipantsAttribute(){
        $user1 = $this->user1;
        $user2 = $this->user2;
        $users = array('participants'=>[$user1,$user2]);
        return $users;
    }




    public function lastMessage()
    {
        return $this->belongsTo(Message::class, 'last_message_id');
    }


}
