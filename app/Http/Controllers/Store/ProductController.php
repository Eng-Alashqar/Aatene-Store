<?php

namespace App\Http\Controllers\Store;

use App\Helpers\PhotoUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Store\Products\ProductRequest;
use App\Models\Store\Product;
use App\Services\Store\CategoryService;
use App\Services\Store\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct(private ProductService $productService, private CategoryService $categoryService)
    {
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
        return view('store.products.create', [
            'categories' => $this->categoryService->getAllCategories()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
        $this->productService->store($request->validated());
        return redirect()->back()->with(['notification' => 'تم اضافة منتج جديد']);
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
            'categories' => $this->categoryService->getParentCategories(),
            'product' => $this->productService->getById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $id)
    {
        $this->productService->update($id, $request->validated);
        return redirect()->route('store.products.index')->with(['notification' => 'تم تعديل بينانات المنتج بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $isDeleted = $this->productService->delete($id);
        return $this->deleteAjaxResponse($isDeleted);
    }

    public function upload(Request $request){
        $file = $request->file('files');
            $photo_obj['photo_slug'] = $file->getClientOriginalName();
            $photo_obj['photo'] = PhotoUpload::upload($file);
        return response()->json(['data'=>$photo_obj],201);
    }
}
