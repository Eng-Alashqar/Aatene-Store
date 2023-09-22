<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\ProductRequest;
use App\Jobs\UserProductNotify;
use App\Models\Store\Product;
use App\Models\Users\User;
use App\Services\NotificationsService;
use App\Services\Store\CategoryService;
use App\Services\Store\ProductService;
use App\Traits\PushNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    use PushNotify ;
    private  $productService;
    private  $categoryService;
    public function __construct(public NotificationsService $notificationsService)
    {
        $this->productService = new ProductService;
        $this->categoryService = new CategoryService;
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
            'categories' => $this->categoryService->getParentCategories(), 'regions' => $this->productService->getStoreRegions()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $result = $this->productService->store($request->validated());


        if ($result){
            $product = Product::find($result->id);
            $users = User::whereHas('following', function ($query) use ($product) {
                            $query->where('store_id', $product->store->id); })->get();

            $this->notificationsService->createNotficatoin($users ,$product);

        }

        return redirect()->back()->with(['notification' => $result ? 'تم اضافة منتج جديد' : 'حدث خلل ما في عملية الاضافة يرجى المحاولة مرة اخرى']);
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
            'categories' => $this->categoryService->getAllCategories(),
            'product' => $this->productService->getById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $id)
    {
        $this->productService->update($id, $request->validated());
        return redirect()->route('dashboard.products.index')->with(['notification' => 'تم تعديل بينانات المنتج بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $isDeleted = $this->productService->delete($id);
        return $this->deleteAjaxResponse($isDeleted);
    }

    public function upload(Request $request)
    {
        return response()->json(['data' => $this->productService->upload($request)], Response::HTTP_OK);
    }

    public function deleteImage(Request $request)
    {
        $file = $request->filename;
        $isDeleted = Storage::disk('s3')->delete($file);
        return response()->json(['isDeleted' => $isDeleted, 'path' => $file], Response::HTTP_OK);
    }

    public function variantsShow()
    {
        return view('store.products.variants');
    }
}
