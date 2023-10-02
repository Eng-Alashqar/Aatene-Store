<?php

namespace App\Http\Controllers\Api\Advertisement;

use App\Http\Controllers\Controller;
use App\Http\Resources\PriceResource;
use App\Models\Advertisement\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prices =   Price::query()->latest()->get();
        return sendResponse(true,'success',PriceResource::collection($prices));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $roles=[
            'amount' => 'required|numeric',
            'ad_type' => 'required|in:store,product,products_list,main_banner,sub_banner',
        ];

        $data = $request->only([
            'amount', 'ad_type'
        ]);
        $validator = Validator::make($data, $roles);
        if (!$validator->fails()) {
            $is_unique = Price::query()->where('ad_type',$request->ad_type)->first();
            if ($is_unique){
                return sendResponse( false,'فشلت العملية !  هنالك سعر مضاف مسبقاََ لهذا النوع من الإعلانات',PriceResource::make($is_unique));
            }
            $price = Price::query()->create($data)->latest()->first();
            if ($price) {
                return sendResponse(true,'تم اضافة سعر للاعلان بنجاح',PriceResource::make($price));
            } else {
                return sendResponse(false,'فشلت العملية !');
            }
        }else{
            return sendResponse(false,$validator->getMessageBag()->first());
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
        $roles=[
            'amount' => 'required|numeric',
            'ad_type' => 'required|in:store,product,products_list,main_banner,sub_banner',
        ];

        $data = $request->only([
            'amount', 'ad_type'
        ]);
        $validator = Validator::make($data, $roles);
        if (!$validator->fails()) {
            $price = Price::query()->find($id)->update($data);
            if ($price) {
                return sendResponse(true,'تم تعديل سعر الاعلان بنجاح');
            } else {
                return sendResponse(false,'فشلت العملية !');
            }
        }else{
            return sendResponse(false,$validator->getMessageBag()->first());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $price=Price::query()->find($id);
        $isDeleted=$price->delete();
        if ($isDeleted){
            return sendResponse(true,'تم حذف سعر الاعلان بنجاح');
        }else{
            return sendResponse(false,'فشلت العملية !');
        }
    }
}
