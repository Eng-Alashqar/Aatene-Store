<?php

namespace App\Http\Controllers\Api\Advertisement;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductAdvertisementResource;
use App\Models\Advertisement\Price;
use App\Models\Advertisement\ProductAdvertisement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductAdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::guard('admin')->check()) {

            $product_adv = ProductAdvertisement::query()->with('product')->latest()->get();
            return sendResponse(true, 'success', ProductAdvertisementResource::collection($product_adv));

        } elseif (Auth::guard('seller')->check()) {
            $product_adv = ProductAdvertisement::query()->with('product')->where('status', '=', 'Active')->latest()->get();
            return sendResponse(true, 'success', ProductAdvertisementResource::collection($product_adv));
        }

    }

    public function indexOrder()
    {
        $product_adv = ProductAdvertisement::query()->with('product')->where('status', '=', 'InActive')->latest()->get();
        return sendResponse(true, 'success', ProductAdvertisementResource::collection($product_adv));


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $roles = [
            'product_id' => 'required|int|exists:products,id',
            'start_at' => 'required|date',
            'end_at' => 'required|date',
        ];
        $data = $request->only(['product_id', 'start_at', 'end_at']);
        $validator = Validator::make($data, $roles);
        if (!$validator->fails()) {
            $price = Price::query()->where('ad_type', '=', 'product')->first();
            $data['price'] = $price->amount;
            $start_at = Carbon::make($request->get('start_at'));
            $end_at = Carbon::make($request->get('end_at'));
            $day_num = $end_at->diffInDays($start_at);
            $data['total'] = $day_num * $price->amount;
            $product_adv = ProductAdvertisement::query()->create($data)->latest()->first();
            if ($product_adv) {
                return sendResponse(true, 'تم انشاء اعلان للمنتج بنجاح',ProductAdvertisementResource::make($product_adv));
            } else {
                return sendResponse(false, 'فشل انشاء اعلان للمنتج ! ');
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
        $roles = [
            'product_id' => 'required|int|exists:products,id',
            'start_at' => 'required|date',
            'end_at' => 'required|date',
        ];
        $data = $request->only(['product_id', 'start_at', 'end_at']);
        $validator = Validator::make($data, $roles);
        if (!$validator->fails()) {
            $price = Price::query()->where('ad_type', '=', 'product')->first();
            $start_at = Carbon::make($request->get('start_at'));
            $end_at = Carbon::make($request->get('end_at'));
            $day_num = $end_at->diffInDays($start_at);
            $data['total'] = $day_num * $price->amount;
            $product_adv = ProductAdvertisement::query()->find($id)->update($data);
            if ($product_adv) {
                return sendResponse(true, 'تم تعديل اعلان المنتج بنجاح');
            } else {
                return sendResponse(false, 'فشل تعديل الاعلان ! ');
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
        $product_adv=ProductAdvertisement::query()->find($id);
        $isDeleted=$product_adv->delete();
        if ($isDeleted){
            return sendResponse(true,'تم حذف الاعلان بنجاح');
        }else{
            return sendResponse(false,'فشلت عملية الحذف !');

        }
    }

    public function orderAccepted($id){
        $product_adv    =   ProductAdvertisement::query()->find($id);
        $product_adv->update([
            'status' => 'Active',
        ]);
        return sendResponse(true,'تمت العملية بنجاح',ProductAdvertisementResource::make($product_adv));
    }
    public function orderRejected($id)
    {
        $product_adv = ProductAdvertisement::query()->find($id);
        $isDeleted = $product_adv->delete();
        if ($isDeleted) {
            return sendResponse(true, 'تم رفض  الاعلان');
        } else {
            return sendResponse(false, 'فشلت العملية !');

        }
    }
}
