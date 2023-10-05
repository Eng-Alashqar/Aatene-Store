<?php

namespace App\Models\Feedback;

use App\Models\Report;
use App\Models\Store\Product;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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
