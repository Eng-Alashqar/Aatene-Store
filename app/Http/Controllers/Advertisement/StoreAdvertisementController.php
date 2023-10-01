<?php

namespace App\Http\Controllers\Advertisement;

use App\Http\Controllers\Controller;
use App\Models\Advertisement\Price;
use App\Models\Advertisement\StoreAdvertisement;
use App\Models\Store\Store;
use Illuminate\Http\Request;

class StoreAdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $count = (int) request()->query('count') ?? 7;
        $store_advertisements=StoreAdvertisement::query()->latest()->paginate($count);
        return view('admin.advertisements.store.index',compact('store_advertisements','count'));
    }
    public function indexOrder()
    {
        $count = (int) request()->query('count') ?? 7;
        $store_advertisements=StoreAdvertisement::query()->where('status','=','InActive')->latest()->paginate($count);
        return view('admin.advertisements.orders.index',compact('store_advertisements','count'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stores=Store::query()->where('status','=','active')->latest()->get();
        $price=Price::query()->where('ad_type','=','store')->first();
        return view('admin.advertisements.store.create',compact('stores','price'));
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
        $store_advertisement = StoreAdvertisement::query()->create($data);
        if ($store_advertisement) {
            return redirect()->back()->with(['notification' => 'تمت العملية بنجاح']);
        } else {
            return redirect()->back()->with(['notification' => 'فشلت عملية اضافة الاعلان']);

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
        $store_advertisement=StoreAdvertisement::query()->findOrFail($id);
        $stores=Store::query()->where('status','=','active')->latest()->get();
        return view('admin.advertisements.store.edit',compact('store_advertisement','stores'));
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
        $data   =   $request->only(['start_at','end_at','price']);
        $store_advertisement=StoreAdvertisement::query()->update($data);
        if ($store_advertisement){
            return redirect()->back()->with(['notification'=>'تمت العملية بنجاح']);
        }else{
            return redirect()->back()->with(['notification'=>'فشلت عملية تعديل الاعلان']);

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

    public function statusOrder($id){
//        $status  =   $request->status;
        $store_advertisement    =   StoreAdvertisement::query()->find($id);
        $store_advertisement->update([
            'status' => 'Active',
        ]);
        return redirect()->back()->with(['notification'=>'تمت العملية بنجاح']);

    }

}
