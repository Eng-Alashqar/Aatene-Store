<?php

namespace App\Http\Controllers\Advertisement;

use App\Http\Controllers\Controller;
use App\Models\Advertisement\Price;
use App\Models\Advertisement\StoreAdvertisement;
use App\Models\Store\Store;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreAdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::guard('admin')->check()){
            $count = (int) request()->query('count') ?? 7;
            $store_advertisements=StoreAdvertisement::query()->with('store')->latest()->paginate($count);
            return view('admin.advertisements.store.index',compact('store_advertisements','count'));

        }elseif (Auth::guard('seller')->check()){
            $count = (int) request()->query('count') ?? 7;
            $store_advertisements=StoreAdvertisement::query()->with('store')->where('store_id', auth()->user()->store_id)->latest()->paginate($count);
            return view('store.advertisements.store.index',compact('store_advertisements','count'));
        }

    }
    public function indexOrder()
    {
        $count = (int) request()->query('count') ?? 7;
        $store_advertisements=StoreAdvertisement::query()->with('store')->where('status','=','InActive')->latest()->paginate($count);
        return view('admin.advertisements.orders.index',compact('store_advertisements','count'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::guard('admin')->check()){
            $stores=Store::query()->where('status','=','active')->latest()->get();
            $price=Price::query()->where('ad_type','=','store')->first();
            return view('admin.advertisements.store.create',compact('stores','price'));
        }elseif(Auth::guard('seller')->check()){
            $store=Store::query()->where('id',auth()->user()->store_id)->first();
            $price=Price::query()->where('ad_type','=','store')->first();
            return view('store.advertisements.store.create',compact('store','price'));
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'store_id' => 'required|int|exists:stores,id',
            'start_at' => 'required|date',
            'end_at' => 'required|date',
        ]);
        $data = $request->only(['store_id', 'start_at', 'end_at']);
        $price = Price::query()->where('ad_type', '=', 'store')->first();
        $data['price'] = $price->amount;
        $start_at = Carbon::make($request->get('start_at'));
        $end_at = Carbon::make($request->get('end_at'));
        $day_num = $end_at->diffInDays($start_at);
        $data['total'] = $day_num * $price->amount;
        $store_advertisement = StoreAdvertisement::query()->create($data);
        if ($store_advertisement) {
            return redirect()->back()->with(['notification' => 'تمت العملية بنجاح']);
        } else {
            return redirect()->back()->with(['notification-error' => 'فشلت عملية اضافة الاعلان']);

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
        if (Auth::guard('admin')->check()){
            $store_advertisement=StoreAdvertisement::query()->findOrFail($id);
            $stores=Store::query()->where('status','=','active')->latest()->get();
            return view('admin.advertisements.store.edit',compact('store_advertisement','stores'));
        }elseif (Auth::guard('seller')->check()){
            $store_advertisement=StoreAdvertisement::query()->findOrFail($id);
            return view('store.advertisements.store.edit',compact('store_advertisement'));
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->request->add(['id'=>$id]);
        $request->validate([
            'id'       =>   'required|int|exists:store_advertisements',
            'start_at' =>   'required|date',
            'end_at'   =>   'required|date',
        ]);
        $data   =   $request->only(['start_at','end_at','total']);
        $price = Price::query()->where('ad_type', '=', 'store')->first();
        $start_at = Carbon::make($request->get('start_at'));
        $end_at = Carbon::make($request->get('end_at'));
        $day_num = $end_at->diffInDays($start_at);
        $data['total'] = $day_num * $price->amount;
        $store_advertisement = StoreAdvertisement::query()->find($id)->update($data);
        if ($store_advertisement){
            return redirect()->back()->with(['notification'=>'تمت العملية بنجاح']);
        }else{
            return redirect()->back()->with(['notification-error'=>'فشلت عملية تعديل الاعلان']);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isDeleted=StoreAdvertisement::destroy($id);
        return $this->deleteAjaxResponse($isDeleted);

    }

    public function orderAccepted($id){
//        $status  =   $request->status;
        $store_advertisement    =   StoreAdvertisement::query()->find($id);
        $store_advertisement->update([
            'status' => 'Active',
        ]);
        return redirect()->back()->with(['notification'=>'تمت العملية بنجاح']);

    }

}
