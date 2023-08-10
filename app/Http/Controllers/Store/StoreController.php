<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\StoreRequest;
use App\Models\Region;
use App\Models\Users\Seller;
use App\Services\Store\RegionService;
use App\Services\Store\StoreService;

class StoreController extends Controller
{
    private  $storeService;
    public function __construct(){
        $this->storeService = new StoreService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = $this->storeService->get();
        return view('admin.stores.index', compact('stores'));
    }


    public function pending()
    {
        $stores = $this->storeService->getPendingStores();
        return view('admin.stores.pending',compact('stores'));
    }

    public function accept($id)
    {
        $this->storeService->acceptStore($id);
        return back()->with(['notification' => 'تمت الاضافة بنجاح']);
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('admin.stores.show', [
            'store' => $this->storeService->getById($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin.stores.edit', [
            'store' => $this->storeService->getById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, $id)
    {
        $this->storeService->update($id, $request->validated());
        return to_route('admin.stores.index')->with(['notification' => 'تمت العملية بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isDeleted = $this->storeService->delete($id);
        return $this->deleteAjaxResponse($isDeleted);
    }
}
