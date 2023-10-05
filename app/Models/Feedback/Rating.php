<?php

namespace App\Models\Feedback;

use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Rating extends Model
{
    use HasFactory;


    public function rateable() : MorphTo
    {
        return $this->morphTo();
    }

    public function reports()
    {
        return $this->morphMany(Report::class , 'reportable');
    }

    public function report()
    {
        return $this->morphOne(Report::class , 'reportable');
    }
}
