<?php

namespace App\Http\Controllers\Advertisement;

use App\Http\Controllers\Controller;
use App\Models\Advertisement\Price;
use App\Models\Advertisement\ProductListAds;
use App\Models\Store\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductListController extends Controller
{
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            $count = (int)request()->query('count') ?? 7;
            $products_list_ads = ProductListAds::query()->latest()->paginate($count);
            return view('admin.advertisements.product.products-list.index', compact('products_list_ads'));

        } elseif (Auth::guard('seller')->check()) {
            $count = (int)request()->query('count') ?? 7;
            $products_list_ads = ProductListAds::query()->whereHas('category', function ($query) {
                $query->whereHas('products', function ($q) {
                    $q->where('store_id', auth()->user()->store_id);
                });
            })->latest()->paginate($count);
            return view('store.advertisements.product.products-list.index', compact('products_list_ads'));
        }

    }

    public function indexOrder()
    {
        $count = (int) request()->query('count') ?? 7;
        $products_list_ads=ProductListAds::query()->where('status','=','InActive')->latest()->paginate($count);
        return view('admin.advertisements.product.products-list.orders.index',compact('products_list_ads'));
    }

    public function create()
    {
        if (Auth::guard('admin')->check()){
            $categories = Category::query()->latest()->get();
            $price = Price::query()->where('ad_type', '=', 'products_list')->first();
            return view('admin.advertisements.product.products-list.create',compact('price','categories'));
        }elseif (Auth::guard('seller')->check()){
            $categories = Category::query()->with('products',function ($query){
                $query->where('store_id',auth()->user()->store_id);
            })->latest()->get();
            $price = Price::query()->where('ad_type', '=', 'products_list')->first();
            return view('store.advertisements.product.products-list.create',compact('price','categories'));
        }

    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' =>   'required|int|exists:categories,id',
            'start_at' =>   'required|date',
            'end_at'   =>   'required|date',
        ]);
        $data   =   $request->only(['category_id','start_at','end_at']);
        $price  = Price::query()->where('ad_type','=','products_list')->first();
        $data['price']=$price->amount;
        $start_at = Carbon::make($request->get('start_at'));
        $end_at = Carbon::make($request->get('end_at'));
        $day_num = $end_at->diffInDays($start_at);
        $data['total'] = $day_num * $price->amount;
        $products_list_ads =   ProductListAds::query()->create($data);
        if ($products_list_ads){
            return redirect()->back()->with(['notification'=>'تمت العملية بنجاح']);
        }else{
            return redirect()->back()->with(['notification-error'=>'فشلت عملية اضافة الاعلان']);

        }
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        if (Auth::guard('admin')->check()){
            $products_list_ads = ProductListAds::query()->findOrFail($id);
                $categories = Category::query()->latest()->get();
            return view('admin.advertisements.product.products-list.edit',compact('categories','products_list_ads'));

        }elseif (Auth::guard('seller')->check()){
            $products_list_ads = ProductListAds::query()->findOrFail($id);
            $categories = Category::query()->with('products',function ($query){
                $query->where('store_id',auth()->user()->store_id);
            })->latest()->get();
            return view('store.advertisements.product.products-list.edit',compact('categories','products_list_ads'));
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' =>   'required|int|exists:categories,id',
            'start_at' =>   'required|date',
            'end_at'   =>   'required|date',
        ]);
        $data   =   $request->only(['category_id','start_at','end_at']);
        $price  = Price::query()->where('ad_type','=','products_list')->first();
        $start_at = Carbon::make($request->get('start_at'));
        $end_at = Carbon::make($request->get('end_at'));
        $day_num = $end_at->diffInDays($start_at);
        $data['total'] = $day_num * $price->amount;
        $products_list_ads =   ProductListAds::query()->find($id)->update($data);
        if ($products_list_ads){
            return redirect()->back()->with(['notification'=>'تمت العملية بنجاح']);
        }else{
            return redirect()->back()->with(['notification-error'=>'فشلت عملية !']);

        }
    }

    public function destroy($id)
    {
        $isDeleted = ProductListAds::destroy($id);
        return $this->deleteAjaxResponse($isDeleted);
    }

    public function orderAccepted($id){
        $products_list_ads   =   ProductListAds::query()->find($id);
        $products_list_ads->update([
            'status' => 'Active',
        ]);
        return redirect()->back()->with(['notification'=>'تمت العملية بنجاح']);

    }
}
