<?php

namespace App\Http\Controllers\Store;

use App\Helpers\PhotoUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreRequest;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreSettingsController extends Controller
{
    public function edit()
    {
        $store = auth()->user()->store;
        $regions = Region::get();
        return view('store.settings.edit', compact('store', 'regions'));
    }

    public function update(StoreRequest $request)
    {

        $store = auth()->user()->store;
        DB::beginTransaction();
        try {
            if ($request->hasFile('logo') && $request->hasFile('cover')) {
                $logo = $request->file('logo');
                $cover = $request->file('cover');
                $store->deleteImage();
                $store->storeImage(PhotoUpload::upload($logo), $logo->getClientOriginalName(), 'logo');
                $store->storeImage( PhotoUpload::upload($cover), $cover->getClientOriginalName(), 'cover');
            }
            $store->update($request->validated());
            $store->regions()->sync($request->regions);
            DB::commit();
            return to_route('dashboard.home')->with(['notification' => 'تمت العملية بنجاح']);
        } catch (\Throwable $ex) {
            DB::rollBack();
            return back()->with(['notification' => 'حدث خطأ اثناء العملية حاول مرة اخرى..']);
        }
    }
}
