<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Store\Order;

class OrderController extends Controller
{
    public function index()
    {
        return view('store.orders.index', [
            'orders' => Order::paginate()
        ]);
    }
}
