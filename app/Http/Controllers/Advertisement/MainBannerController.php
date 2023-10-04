<?php

namespace App\Http\Controllers\Advertisement;

use App\Helpers\PhotoUpload;
use App\Http\Controllers\Controller;
use App\Models\Advertisement\MainBanner;
use App\Models\Advertisement\Price;
use App\Models\Store\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

class MainBannerController extends Controller
{
    public function index()
    {
        if (Auth::guard('admin')->check()) {

            $count = (int)request()->query('count') ?? 7;
            $main_banner_ads = MainBanner::query()->with('store')->latest()->paginate($count);
            return view('admin.advertisements.banners.main.index', compact('main_banner_ads'));

        } elseif (Auth::guard('seller')->check()) {

            $count = (int)request()->query('count') ?? 7;
            $main_banner_ads = MainBanner::query()->with('store')->where('store_id',auth()->user()->store_id)->latest()->paginate($count);
            return view('store.advertisements.banners.main.index', compact('main_banner_ads'));
        }

    }

    public function indexOrder()
    {
        $count = (int) request()->query('count') ?? 7;
        $main_banner_ads=MainBanner::query()->with('store')->where('status','=','InActive')->latest()->paginate($count);
        return view('admin.advertisements.banners.main.orders.index',compact('main_banner_ads'));
    }

    public function create()
    {
        if (Auth::guard('admin')->check()) {

            $stores = Store::query()->latest()->get();
            $price = Price::query()->where('ad_type', '=', 'main_banner')->first();
            return view('admin.advertisements.banners.main.create', compact('stores', 'price'));

        } elseif (Auth::guard('seller')->check()) {

            $stores = Store::query()->where('id', auth()->user()->store_id)->latest()->get();
            $price = Price::query()->where('ad_type', '=', 'main_banner')->first();
            return view('store.advertisements.banners.main.create', compact('stores', 'price'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'store_id' =>   'required|int|exists:stores,id',
            'start_at' =>   'required|date',
            'end_at'   =>   'required|date',
            'image.*'    =>   'required|image',
        ]);
        $data   =   $request->only(['store_id','start_at','end_at']);
        $price  = Price::query()->where('ad_type','=','main_banner')->first();
        $data['price']=$price->amount;
        $start_at = Carbon::make($request->get('start_at'));
        $end_at = Carbon::make($request->get('end_at'));
        $day_num = $end_at->diffInDays($start_at);
        $data['total'] = $day_num * $price->amount;

        $data = $this->uploadImages($request, $data);

        $main_banner_ads =   MainBanner::query()->create($data);

        if ($main_banner_ads){
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
        if (Auth::guard('admin')->check()) {
            $main_banner_ads=MainBanner::query()->findOrFail($id);
            $stores = Store::query()->latest()->get();
            return view('admin.advertisements.banners.main.edit', compact('stores','main_banner_ads'));

        } elseif (Auth::guard('seller')->check()) {
            $main_banner_ads=MainBanner::query()->findOrFail($id);
            $stores = Store::query()->where('id', auth()->user()->store_id)->latest()->get();
            return view('store.advertisements.banners.main.edit', compact('stores','main_banner_ads'));
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'store_id' =>   'required|int|exists:stores,id',
            'start_at' =>   'required|date',
            'end_at'   =>   'required|date',
        ]);
        $data   =   $request->only(['store_id','start_at','end_at','total']);
        $price  = Price::query()->where('ad_type','=','main_banner')->first();
        $start_at = Carbon::make($request->get('start_at'));
        $end_at = Carbon::make($request->get('end_at'));
        $day_num = $end_at->diffInDays($start_at);
        $data['total'] = $day_num * $price->amount;

        $data = $this->uploadImages($request, $data);

        $main_banner_ads =   MainBanner::query()->find($id)->update($data);
        if ($main_banner_ads){
            return redirect()->back()->with(['notification'=>'تمت العملية بنجاح']);
        }else{
            return redirect()->back()->with(['notification-error'=>'فشلت عملية اضافة الاعلان']);
        }
    }

    public function destroy(string $id)
    {
        $mainBanner = MainBanner::find($id);
        $isDeleted = $mainBanner->delete();
       return $this->deleteAjaxResponse($isDeleted);

    }

    public function orderAccepted($id){
        $main_banner_ads   =   MainBanner::query()->find($id);
        $main_banner_ads->update([
            'status' => 'Active',
        ]);
        return redirect()->back()->with(['notification'=>'تمت العملية بنجاح']);

    }


    public function uploadImages(Request $request, array $data): array
    {
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $Image = $image;
                $imageName = $Image->getClientOriginalName() . '_' . $Image->getClientOriginalExtension();
                $images[] = $imageName;
                $Image->move('assets/media/ads/main-banners/', $imageName);
            }
            $data['image'] = json_encode($images);
        }
        return $data;
    }
}
