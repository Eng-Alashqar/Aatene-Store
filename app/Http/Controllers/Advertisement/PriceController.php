<?php

namespace App\Http\Controllers\Advertisement;

use App\Http\Controllers\Controller;
use App\Models\Advertisement\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prices=Price::query()->latest()->get();
        return view('admin.advertisements.price.index',compact('prices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.advertisements.price.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'ad_type' => 'required|in:store,product,main_banner,sub_banner',
        ]);
        $data = $request->only([
            'amount', 'ad_type'
        ]);
        $is_unique = Price::query()->where('ad_type',$request->ad_type)->first();
        if ($is_unique){
            return redirect()->back()->with(['notification-error' => 'فشلت العملية !  هنالك سعر مضاف مسبقاََ لهذا النوع من الإعلانات']);
        }
        $price = Price::query()->create($data);
        if ($price) {
            return redirect()->back()->with(['notification' => 'تمت العملية بنجاح']);
        } else {
            return redirect()->back()->with(['notification' => 'فشلت العملية !']);
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
    public function edit(Price $price)
    {
        return view('admin.advertisements.price.edit', compact('price'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Price $price)
    {
        $request->request->add(['id' => $price->id]);
        $request->validate([
            'id' => 'required|int|exists:prices',
            'amount' => 'required|numeric',
            'ad_type' => 'required|in:store,product,main_banner,sub_banner',
        ]);
        $data = $request->only([
            'amount', 'ad_type'
        ]);
        $is_unique = Price::query()->where('ad_type',$request->ad_type)->first();
        if ($is_unique){
            return redirect()->back()->with(['notification-error' => 'فشلت العملية !  هنالك سعر مضاف مسبقاََ لهذا النوع من الإعلانات']);
        }
        $price = $price->update($data);
        if ($price) {
            return redirect()->back()->with(['notification' => 'تمت العملية بنجاح']);
        } else {
            return redirect()->back()->with(['notification' => 'فشلت العملية !']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isDeleted = Price::destroy($id);
        return $this->deleteAjaxResponse($isDeleted);
    }
}
