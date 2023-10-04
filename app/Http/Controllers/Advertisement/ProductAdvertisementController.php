<?php

namespace App\Http\Controllers\Advertisement;

use App\Http\Controllers\Controller;
use App\Models\Advertisement\Price;
use App\Models\Advertisement\ProductAdvertisement;
use App\Models\Store\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductAdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            $count = (int)request()->query('count') ?? 7;
            $product_ads = ProductAdvertisement::query()->with('product')->latest()->paginate($count);
            return view('admin.advertisements.product.index', compact('product_ads'));

        } elseif (Auth::guard('seller')->check()) {
            $count = (int)request()->query('count') ?? 7;
            $product_ads = ProductAdvertisement::query()->whereHas('product', function ($query) {
                $query->where('store_id', auth()->user()->store_id);
            })->latest()->paginate($count);
            return view('store.advertisements.product.index', compact('product_ads'));
        }

    }

    public function indexOrder()
    {
        $count = (int) request()->query('count') ?? 7;
        $product_ads=ProductAdvertisement::query()->with('product')->where('status','=','InActive')->latest()->paginate($count);
        return view('admin.advertisements.orders.productOrders',compact('product_ads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::guard('admin')->check()){
            $products = Product::query()->latest()->get();
            $price = Price::query()->where('ad_type', '=', 'product')->first();
            return view('admin.advertisements.product.create', compact('products', 'price'));
        }elseif (Auth::guard('seller')->check()){
            $products = Product::query()->where('store_id',auth()->user()->store_id)->latest()->get();
            $price = Price::query()->where('ad_type', '=', 'product')->first();
            return view('store.advertisements.product.create', compact('products', 'price'));
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' =>   'required|int|exists:products,id',
            'start_at' =>   'required|date',
            'end_at'   =>   'required|date',
        ]);
        $data   =   $request->only(['product_id','start_at','end_at']);
        $price  = Price::query()->where('ad_type','=','product')->first();
        $data['price']=$price->amount;
        $start_at = Carbon::make($request->get('start_at'));
        $end_at = Carbon::make($request->get('end_at'));
        $day_num = $end_at->diffInDays($start_at);
        $data['total'] = $day_num * $price->amount;
        $pro_ad =   ProductAdvertisement::query()->create($data);
        if ($pro_ad){
            return redirect()->back()->with(['notification'=>'تمت العملية بنجاح']);
        }else{
            return redirect()->back()->with(['notification-error'=>'فشلت عملية اضافة الاعلان']);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Auth::guard('admin')->check()) {
            $pro_ad = ProductAdvertisement::query()->findOrFail($id);
            $products = Product::query()->latest()->get();
            $price = Price::query()->where('ad_type', '=', 'product')->first();
            return view('admin.advertisements.product.edit', compact('products', 'price', 'pro_ad'));
        } elseif (Auth::guard('seller')->check()) {
            $pro_ad = ProductAdvertisement::query()->findOrFail($id);
            $products = Product::query()->where('store_id', auth()->user()->store_id)->latest()->get();
            return view('store.advertisements.product.edit', compact('products', 'pro_ad'));
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_id' => 'required|int|exists:products,id',
            'start_at' => 'required|date',
            'end_at' => 'required|date',
        ]);
        $data = $request->only(['product_id', 'start_at', 'end_at', 'total']);
        $price = Price::query()->where('ad_type', '=', 'product')->first();
        $start_at = Carbon::make($request->get('start_at'));
        $end_at = Carbon::make($request->get('end_at'));
        $day_num = $end_at->diffInDays($start_at);
        $data['total'] = $day_num * $price->amount;
        $pro_ad = ProductAdvertisement::query()->update($data);
        if ($pro_ad) {
            return redirect()->back()->with(['notification' => 'تمت العملية بنجاح']);
        } else {
            return redirect()->back()->with(['notification-error' => 'فشلت عملية اضافة الاعلان']);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isDeleted  =   ProductAdvertisement::destroy($id);
        return $this->deleteAjaxResponse($isDeleted);
    }

    public function orderAccepted($id){
        $pro_ad   =   ProductAdvertisement::query()->find($id);
        $pro_ad->update([
            'status' => 'Active',
        ]);
        return redirect()->back()->with(['notification'=>'تمت العملية بنجاح']);

    }
}
