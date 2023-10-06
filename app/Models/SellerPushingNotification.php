<?php

namespace App\Models;

use App\Models\Users\Seller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerPushingNotification extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }
}
