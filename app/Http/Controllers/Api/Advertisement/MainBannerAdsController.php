<?php

namespace App\Http\Controllers\Api\Advertisement;

use App\Http\Controllers\Controller;
use App\Http\Resources\MainBannerResource;
use App\Models\Advertisement\MainBanner;
use App\Models\Advertisement\Price;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MainBannerAdsController extends Controller
{
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            $main_banner_ads = MainBanner::query()->with('store')->latest()->get();
         return sendResponse(true,'success',MainBannerResource::collection($main_banner_ads));

        } elseif (Auth::guard('seller')->check()) {

            $main_banner_ads = MainBanner::query()->with('store')->where('store_id',auth()->user()->store_id)->latest()->get();
            return sendResponse(true,'success',MainBannerResource::collection($main_banner_ads));
        }

    }
    public function indexOrder()
    {
        $main_banner_ads=MainBanner::query()->with('store')->where('status','=','InActive')->latest()->get();
        return sendResponse(true,'success',MainBannerResource::collection($main_banner_ads));
    }

    public function store(Request $request)
    {
        $roles=[
            'store_id' =>   'required|int|exists:stores,id',
            'start_at' =>   'required|date',
            'end_at'   =>   'required|date',
            'image.*'  =>   'required|image|array|between:1,5',
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
            $price  = Price::query()->where('ad_type','=','main_banner')->first();
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
                    $Image->move('assets/media/ads/main-banners/', $imageName);
                }
                $data['image'] = json_encode($images);
            }
            $main_banner_ads =   MainBanner::query()->create($data)->latest()->first();
            if ($main_banner_ads){
                return sendResponse(true,'تمت العملية بنجاح',MainBannerResource::make($main_banner_ads));
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
            $price  = Price::query()->where('ad_type','=','main_banner')->first();
            $start_at = Carbon::make($request->get('start_at'));
            $end_at = Carbon::make($request->get('end_at'));
            $day_num = $end_at->diffInDays($start_at);
            $data['total'] = $day_num * $price->amount;
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $Image = $image;
                    $imageName = $Image->getClientOriginalName() . '_' . $Image->getClientOriginalExtension();
                    $images[] = $imageName;
                    $Image->move('assets/media/ads/main-banners/', $imageName);
                }
                $data['image'] = json_encode($images);
            }
            $main_banner_ads =   MainBanner::query()->find($id)->update($data);
            if ($main_banner_ads){
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
        $main_banner=MainBanner::query()->find($id);
        $isDeleted=$main_banner->delete();
        if ($isDeleted){
            return sendResponse(true,'تم حذف الاعلان بنجاح');
        }else{
            return sendResponse(false,'فشلت العملية !');
        }
    }

    public function orderAccepted($id){
        $main_banner    =   MainBanner::query()->find($id);
        $main_banner->update([
            'status' => 'Active',
        ]);
        return sendResponse(true,'تمت العملية بنجاح',MainBannerResource::make($main_banner));
    }
    public function orderRejected($id)
    {
        $main_banner = MainBanner::query()->find($id);
        $isDeleted = $main_banner->delete();
        if ($isDeleted) {
            return sendResponse(true, 'تم رفض  الاعلان');
        } else {
            return sendResponse(false, 'فشلت العملية !');

        }
    }

}
