<?php

namespace App\Models\Store;

use App\Models\Order\OrderAddress;
use App\Models\Order\OrderItem;
use App\Models\Order\Product;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id', 'user_id', 'status',
        'payment_status','product_id','name'
        ,'total','status' ,'quantity'];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(['name' => 'User Deleted']);
    }

    public function products()
    {
        return $this->belongsTo(Product::class)->withDefault(['name' => 'Product Deleted']);
    }



}
