<?php

namespace App\Http\Controllers\Api\Store;

use App\Helpers\OrderTotal;
use App\Http\Controllers\Controller;
use App\Models\Store\Order;
use App\Models\Store\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user')->only(['index', 'store', 'show', 'destroy']);
//        $this->middleware('auth:seller')->only(['index']);
    }

    /** @noinspection PhpUndefinedFieldInspection */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $user = auth()->user();
        $orderedProducts = $user->orders?->with('product')->get();
        return response()->json(['status' => (bool)$orderedProducts, 'data' => $orderedProducts], Response::HTTP_OK);
    }

    /** @noinspection PhpUndefinedMethodInspection */
    public function store(Request $request ): \Illuminate\Http\JsonResponse
    {
        $product = Product::findOrFail($request->product_id);
        $request->validate([
            'quantity' => ['required', 'int', 'min:1'],
//            'variant_id'=>['required'],
//            'region_id'=>['required']
        ]);
        $user = auth()->user();
        if (!$user->orders()->where('product_id', $product->id))
        {
            $order = Order::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'store_id' => $product->store_id,
                'status' => 'completed',
                'payment_status' => 'pending',
                'name' => $product->name,
                'total' => OrderTotal::calculateTotalCost($product),
                'quantity' => $request->quantity,
            ]);
            return response()->json(['status' => (bool)$order, 'data' => $order->load('product'), 'message' => 'تم طلب المنتج وإضافته إلى قائمة الطلبات']);
        }

        return response()->json(['status' => false, 'message' => 'لقد طلبت هذا المنتج مسبقاً']);
    }

    public function show(Order $order)
    {
        $user = auth()->user();
        if ($order->user_id !== $user->id) {
            return response()->json(['message' => 'You are not authorized to view this order.'], Response::HTTP_FORBIDDEN);
        }
        return response()->json(['status' => (bool)$order->product, 'data' => $order->load('product')]);
    }


    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(['message' => 'تم حذف الطلب بنجاح']);
    }
}
