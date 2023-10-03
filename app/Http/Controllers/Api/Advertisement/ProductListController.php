<?php

namespace App\Http\Controllers\Api\Advertisement;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductListAdsResource;
use App\Models\Advertisement\Price;
use App\Models\Advertisement\ProductListAds;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductListController extends Controller
{
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            $products_list_ads = ProductListAds::query()->latest()->get();
          return sendResponse(true,'success',ProductListAdsResource::collection($products_list_ads));

        } elseif (Auth::guard('seller')->check()) {
            $products_list_ads = ProductListAds::query()->whereHas('category', function ($query) {
                $query->whereHas('products', function ($q) {
                    $q->where('store_id', auth()->user()->store_id);
                });
            })->latest()->get();
            return sendResponse(true,'success',ProductListAdsResource::collection($products_list_ads));
        }
    }

    public function indexOrder()
    {
        $products_list_ads = ProductListAds::query()->where('status', '=', 'InActive')->latest()->get();
        return sendResponse(true, 'success', ProductListAdsResource::collection($products_list_ads));
    }

    public function store(Request $request)
    {
        $roles = [
            'category_id' => 'required|int|exists:categories,id',
            'start_at' => 'required|date',
            'end_at' => 'required|date',
        ];
        $data = $request->only(['category_id', 'start_at', 'end_at']);
        $validator = Validator::make($data, $roles);
        if (!$validator->fails()) {
            $price = Price::query()->where('ad_type', '=', 'products_list')->first();
            $data['price'] = $price->amount;
            $start_at = Carbon::make($request->get('start_at'));
            $end_at = Carbon::make($request->get('end_at'));
            $day_num = $end_at->diffInDays($start_at);
            $data['total'] = $day_num * $price->amount;
            $products_list_ads = ProductListAds::query()->create($data)->latest()->first();
            if ($products_list_ads) {
                return sendResponse(true, 'تم انشاء اعلان لقائمة المنتجات بنجاح',ProductListAdsResource::make($products_list_ads));
            } else {
                return sendResponse(false, 'فشل انشاء اعلان لقائمة المنتجات ! ');
            }
        } else {
            return sendResponse(false, $validator->getMessageBag()->first());
        }
    }

    public function show($id)
    {
    }

    public function update(Request $request, $id)
    {
        $roles = [
            'category_id' => 'required|int|exists:categories,id',
            'start_at' => 'required|date',
            'end_at' => 'required|date',
        ];
        $data = $request->only(['category_id', 'start_at', 'end_at']);
        $validator = Validator::make($data, $roles);
        if (!$validator->fails()) {
            $price = Price::query()->where('ad_type', '=', 'products_list')->first();
            $start_at = Carbon::make($request->get('start_at'));
            $end_at = Carbon::make($request->get('end_at'));
            $day_num = $end_at->diffInDays($start_at);
            $data['total'] = $day_num * $price->amount;
            $products_list_ads = ProductListAds::query()->find($id)->update($data);
            if ($products_list_ads) {
                return sendResponse(true, 'تم تعديل الاعلان لقائمة المنتجات بنجاح');
            } else {
                return sendResponse(false, 'فشل تعديل الاعلان لقائمة المنتجات ! ');
            }
        } else {
            return sendResponse(false, $validator->getMessageBag()->first());
        }
    }

    public function destroy($id)
    {
        $products_list_ads=ProductListAds::query()->find($id);
        $isDeleted=$products_list_ads->delete();
        if ($isDeleted){
            return sendResponse(true, 'تمت عملية الحذف بنجاح');
        }else{
            return sendResponse(false, 'فشلت عملية الحذف !');
        }
    }

    public function orderAccepted($id){
        $products_list_ads    =   ProductListAds::query()->find($id);
        $products_list_ads->update([
            'status' => 'Active',
        ]);
        return sendResponse(true,'تمت العملية بنجاح',ProductListAdsResource::make($products_list_ads));
    }
    public function orderRejected($id)
    {
        $products_list_ads = ProductListAds::query()->find($id);
        $isDeleted = $products_list_ads->delete();
        if ($isDeleted) {
            return sendResponse(true, 'تم رفض  الاعلان');
        } else {
            return sendResponse(false, 'فشلت العملية !');

        }
    }
}
