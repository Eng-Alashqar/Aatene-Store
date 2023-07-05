<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shared\ProductRequest;
use App\Models\Product;
use App\Services\Shared\ProductService;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    private ProductService $productService;
    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('store.products.index', [
            'products' => $this->productService->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('store.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $this->productService->store($request->validated());
        return redirect()->back()->with(
            $this->productService->getMessage('success', 'تم اضافة منتج جديد')
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('store.products.show', ['product' => $this->productService->getById($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('store.products.edit', [
            'product' => $this->productService->getById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $id)
    {
        $this->productService->update($id, $request->validated);
        return redirect()->back()->with(
            $this->productService->getMessage(
                'success',
                'تم تعديل بينانات المنتج بنجاح'
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->productService->delete($id);
        return redirect()->back()->with($this->productService->ajaxResponse());
    }
}
