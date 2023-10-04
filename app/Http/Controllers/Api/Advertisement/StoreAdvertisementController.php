<?php

namespace App\Http\Controllers\Api\Advertisement;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\StoreAdvertisementResource;
use App\Models\Advertisement\Price;
use App\Models\Advertisement\StoreAdvertisement;
use App\Models\Store\Store;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class StoreAdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::guard('admin')->check()){
            $store_advertisement = StoreAdvertisement::query()->with('store')->latest()->get();
            return sendResponse(true, 'success',StoreAdvertisementResource::collection($store_advertisement));

        }elseif (Auth::guard('seller')->check()){
            $store_advertisement = StoreAdvertisement::query()
                ->with('store')
                ->where('store_id',auth()->user()->store_id)
                ->where('status','=','Active')
                ->latest()
                ->get();
            return sendResponse(true, 'success',StoreAdvertisementResource::collection($store_advertisement));
        }

    }

    public function indexOrder()
    {
        $store_advertisement = StoreAdvertisement::query()->with('store')->where('status','=','InActive')->latest()->get();

        return sendResponse(true, 'success',StoreAdvertisementResource::collection($store_advertisement));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $roles = [
            'store_id' => 'required|int|exists:stores,id',
            'start_at' => 'required|date',
            'end_at' => 'required|date',
        ];
        $data = $request->only(['store_id', 'start_at', 'end_at']);
        $validator = Validator::make($data, $roles);
        if (!$validator->fails()) {
            $price = Price::query()->where('ad_type', '=', 'store')->first();
            $data['price'] = $price->amount;
            $start_at = Carbon::make($request->get('start_at'));
            $end_at = Carbon::make($request->get('end_at'));
            $day_num = $end_at->diffInDays($start_at);
            $data['total'] = $day_num * $price->amount;
            $store_advertisement = StoreAdvertisement::query()->create($data)->latest()->first();
            if ($store_advertisement) {
                return sendResponse(true, 'تم انشاء اعلان للمتجر بنجاح',StoreAdvertisementResource::make($store_advertisement));
            } else {
                return sendResponse(false, 'فشل انشاء اعلان للمتجر ! ');
            }
        } else {
            return sendResponse(false, $validator->getMessageBag()->first());
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->request->add(['id'=>$id]);
        $roles = [
//            'id' => 'required|int|exists:store_advertisements',
            'store_id' => 'required|int|exists:stores,id',
            'start_at' => 'required|date',
            'end_at' => 'required|date',
        ];
        $data = $request->only(['store_id', 'start_at', 'end_at']);
        $validator = Validator::make($data, $roles);
        if (!$validator->fails()) {
            $price = Price::query()->where('ad_type', '=', 'store')->first();
            $start_at = Carbon::make($request->get('start_at'));
            $end_at = Carbon::make($request->get('end_at'));
            $day_num = $end_at->diffInDays($start_at);
            $data['total'] = $day_num * $price->amount;
            $store_advertisement = StoreAdvertisement::query()->find($id)->update($data);
            if ($store_advertisement) {
                return sendResponse(true, 'تم تعديل اعلان المتجر بنجاح');
            } else {
                return sendResponse(false, 'فشل تعديل اعلان المتجر ! ');
            }
        } else {
            return sendResponse(false, $validator->getMessageBag()->first());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $store_advertisement=StoreAdvertisement::query()->findOrFail($id);
        $isDeleted=$store_advertisement->delete();
        if ($isDeleted){
            return sendResponse(true,'تم حذف الاعلان بنجاح');
        }else{
            return sendResponse(false,'فشلت عملية الحذف !');

        }
    }

    public function orderAccepted($id){
//        $status  =   $request->status;
        $store_advertisement    =   StoreAdvertisement::query()->find($id);
        $store_advertisement->update([
            'status' => 'Active',
        ]);
        return sendResponse(true,'تمت العملية بنجاح',StoreAdvertisementResource::make($store_advertisement));
    }
    public function orderRejected($id){
        $store_advertisement    =   StoreAdvertisement::query()->find($id);
        $isDeleted=$store_advertisement->delete();
        if ($isDeleted){
            return sendResponse(true,'تم رفض  الاعلان');
        }else{
            return sendResponse(false,'فشلت العملية !');

        }
    }

}
