<?php

namespace App\Models\MultimediaHub;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'location', 'salary', 'company', 'type', 'place', 'deadline'];
}
