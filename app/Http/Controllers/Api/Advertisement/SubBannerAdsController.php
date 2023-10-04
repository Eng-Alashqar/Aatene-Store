<?php

namespace App\Http\Controllers\Api\Advertisement;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubBannerResource;
use App\Models\Advertisement\Price;
use App\Models\Advertisement\SubBanner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SubBannerAdsController extends Controller
{
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            $sub_banner_ads = SubBanner::query()->with('store')->latest()->get();
            return sendResponse(true,'success',SubBannerResource::collection($sub_banner_ads));

        } elseif (Auth::guard('seller')->check()) {

            $sub_banner_ads = SubBanner::query()->with('store')->where('store_id',auth()->user()->store_id)->latest()->get();
            return sendResponse(true,'success',SubBannerResource::collection($sub_banner_ads));
        }

    }
    public function indexOrder()
    {
        $sub_banner_ads=SubBanner::query()->with('store')->where('status','=','InActive')->latest()->get();
        return sendResponse(true,'success',SubBannerResource::collection($sub_banner_ads));
    }

    public function store(Request $request)
    {
        $roles=[
            'store_id' =>   'required|int|exists:stores,id',
            'start_at' =>   'required|date',
            'end_at'   =>   'required|date',
            'image.*'    =>   'required|image',
        ];
        $data   =   $request->only(['store_id','start_at','end_at']);
        if ($request->hasFile('images')) {
            $imageCount = count($request->file('images'));
            if ($imageCount > 5) {
                return sendResponse(false, 'يجب رفع 5 صور أو اقل  فقط.');
            }
        }
        $validator = Validator::make($data, $roles);
        if (!$validator->fails()) {
            $price  = Price::query()->where('ad_type','=','sub_banner')->first();
            $data['price']=$price->amount;
            $start_at = Carbon::make($request->get('start_at'));
            $end_at = Carbon::make($request->get('end_at'));
            $day_num = $end_at->diffInDays($start_at);
            $data['total'] = $day_num * $price->amount;
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $Image = $image;
                    $imageName = $Image->getClientOriginalName() . '_' . $Image->getClientOriginalExtension();
                    $images[] = $imageName;
                    $Image->move('assets/media/ads/sub-banners/', $imageName);
                }
                $data['image'] = json_encode($images);
            }
            $sub_banner_ads =   SubBanner::query()->create($data)->latest()->first();
            if ($sub_banner_ads){
                return sendResponse(true,'تمت العملية بنجاح',SubBannerResource::make($sub_banner_ads));
            }else{
                return sendResponse(false,'فشلت العملية');
            }
        }else{
            return sendResponse(false,$validator->getMessageBag()->first());
        }

    }

    public function show($id)
    {
    }

    public function update(Request $request, $id)
    {
        $roles=[
            'store_id' =>   'required|int|exists:stores,id',
            'start_at' =>   'required|date',
            'end_at'   =>   'required|date',
            'image.*'    =>   'required|image',
        ];
        $data   =   $request->only(['store_id','start_at','end_at','total']);
        if ($request->hasFile('images')) {
            $imageCount = count($request->file('images'));
            if ($imageCount > 5) {
                return sendResponse(false, 'يجب رفع 5 صور أو اقل  فقط.');
            }
        }
        $validator = Validator::make($data, $roles);
        if (!$validator->fails()) {
            $price  = Price::query()->where('ad_type','=','sub_banner')->first();
            $start_at = Carbon::make($request->get('start_at'));
            $end_at = Carbon::make($request->get('end_at'));
            $day_num = $end_at->diffInDays($start_at);
            $data['total'] = $day_num * $price->amount;
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $Image = $image;
                    $imageName = $Image->getClientOriginalName() . '_' . $Image->getClientOriginalExtension();
                    $images[] = $imageName;
                    $Image->move('assets/media/ads/sub-banners/', $imageName);
                }
                $data['image'] = json_encode($images);
            }
            $sub_banner_ads =   SubBanner::query()->find($id)->update($data);
            if ($sub_banner_ads){
                return sendResponse(true,'تمت العملية بنجاح');
            }else{
                return sendResponse(false,'فشلت العملية');
            }
        }else{
            return sendResponse(false,$validator->getMessageBag()->first());
        }
    }

    public function destroy($id)
    {
        $sub_banner_ads=SubBanner::query()->find($id);
        $isDeleted=$sub_banner_ads->delete();
        if ($isDeleted){
            return sendResponse(true,'تم حذف الاعلان بنجاح');
        }else{
            return sendResponse(false,'فشلت العملية !');
        }
    }

    public function orderAccepted($id){
        $sub_banner_ads    =   SubBanner::query()->find($id);
        $sub_banner_ads->update([
            'status' => 'Active',
        ]);
        return sendResponse(true,'تمت العملية بنجاح',SubBannerResource::make($sub_banner_ads));
    }
    public function orderRejected($id)
    {
        $sub_banner_ads = SubBanner::query()->find($id);
        $isDeleted = $sub_banner_ads->delete();
        if ($isDeleted) {
            return sendResponse(true, 'تم رفض  الاعلان');
        } else {
            return sendResponse(false, 'فشلت العملية !');

        }
    }
}
