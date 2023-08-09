<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Store\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $orderedProducts = $user->orders->with('product')->get();

        return response()->json($orderedProducts);
    }

    public function store(Product $product)
    {
        $user = auth()->user;

        if (!$user->orders()->where('product_id', $product->id)) {
            $order = new Order([
                'user_id' => $user->id,
                'product->id' => $product->id,
                'store_id' => $product->store_id
            ]);
            $order->save();

            return response()->json(['message' => 'تم طلب المنتج وإضافته إلى قائمة الطلبات']);
        }

        return response()->json(['message' => 'لقد طلبت هذا المنتج مسبقاً']);
    }

    public function show(Order $order)
    {
        $user = auth()->user();

        if ($order->user_id !== $user->id) {
            return response()->json(['message' => 'You are not authorized to view this order.'], 403);
        }

        return response()->json($order->product);
    }


    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json(['message' => 'تم حذف الطلب بنجاح']);
    }
}
