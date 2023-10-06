<?php

namespace App\Models;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function reportable()
    {
        return $this->morphTo();
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($report){

        $this->user_id = auth()->guard('user')->user()->id ;

        });
    }

//    public function reports()
//    {
//        $this->morphMany(Report::class , 'reportable');
//    }
//
//    public function report()
//    {
//        $this->morphOne(Report::class , 'reportable');
//    }

}
