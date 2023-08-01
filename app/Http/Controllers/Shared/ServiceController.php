<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shared\ServiceRequest;
use App\Models\Store\Service;
use App\Services\Admin\CategoryService;
use App\Services\Shared\TheService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct(
        private TheService $theService,
        private CategoryService $categoryService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('store.services.index', [
            'services' => $this->theService->get(7),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('store.services.create', [
            'categories' => $this->categoryService->getParentCategories(),
            'service' => new Service()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        dd($request);
        $this->theService->store($request->validated());
        return redirect()->back()->with(['notification' => 'تم اضافة خدمة جديدة']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('store.products.show', ['product' => $this->theService->getById($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('store.products.edit', [
            'categories' => $this->categoryService->getParentCategories(),
            'product' => $this->theService->getById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $request, $id)
    {
        $this->theService->update($id, $request->validated());
        return redirect()->back()->with(['notification' => 'تم تعديل بينانات المنتج بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $isDeleted = $this->theService->delete($id);
        return $this->deleteAjaxResponse($isDeleted);
    }
}
