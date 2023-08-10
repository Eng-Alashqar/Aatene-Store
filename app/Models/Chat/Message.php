<?php

namespace App\Models\Chat;

use App\Models\Chat\Recipient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation_id',
        'sender_id', // If needed
        'sender_type', // If needed
        'body',
        'type',
        'read_at'
    ];


    public function conversation()
    {
        return $this->belongsTo(Conversation::class,'conversation_id','id');
    }


    public function sender()
    {
        return $this->morphTo();
    }


    protected $cast = [
        'read_at'=>'datetime'
    ];
}
