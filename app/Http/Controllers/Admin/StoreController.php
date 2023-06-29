<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRequest;
use App\Services\Admin\StoreService;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    private $storeService;
    public function __construct(StoreService $storeService) {
        $this->storeService = $storeService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = $this->storeService->get();
        return view('admin.stores.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $this->storeService->store($request->validated());
        return back()->with($this->storeService->getMessage('تمت العملية بنجاح','success'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('admin.stores.show',[
            'store'=>$this->storeService->getById($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin.stores.edit',[
            'store'=>$this->storeService->getById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request,$id)
    {
        $this->storeService->update($id,$request->validated());
        return to_route('admin.stores.index')->with($this->storeService->getMessage('تمت العملية بنجاح','success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->storeService->delete($id);
        return back()->with($this->storeService->ajaxResponse());
    }
}
