<?php

namespace App\Models\Chat;

use App\Models\Chat\Recipient;
use App\Models\Chat\Conversation;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
