<?php

namespace App\Http\Controllers\Api\Store;

use App\Helpers\PhotoUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductRequest;
use App\Models\Store\Product;
use App\Notifications\ReportProductNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:seller')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $filters = request()->query();
        $products = Product::with(['store', 'category', 'tags', 'options', 'favorites', 'variants', 'shippingAddressCost'])->filter($filters)->paginate();
        return response()->json(['status' => (bool)$products, 'data' => $products], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $product = Product::create($request->validated());
            $this->saveFiles($request, $product);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'Sorry, something went wrong, please try again!'], Response::HTTP_BAD_REQUEST);
        }
        return response()->json(['status' => true, 'data' => $product], Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);
        } catch (\Throwable $ex) {
            return response()->json(['status' => false, 'message' => 'Sorry, something went wrong,this product dose not exist.'], Response::HTTP_BAD_REQUEST);
        }
        return response()->json(['status' => true, 'data' => $product->load(['store', 'category', 'tags', 'options', 'favorites', 'variants', 'shippingAddressCost'])], Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $id): \Illuminate\Http\JsonResponse
    {
        DB::beginTransaction();
        try {
            $product = Product::findOrFail($id);

            $product->update($request->validated());
            $this->saveFiles($request, $product, true);
            DB::commit();

        } catch (\Throwable $e) {
            return response()->json(['status' => false, 'message' => 'Sorry, something went wrong, please try again!'], Response::HTTP_CREATED);
        }
        return response()->json(['status' => true, 'data' => $product], Response::HTTP_CREATED);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return response()->json(['status' => true, 'message' => 'The product deleted successfully'], Response::HTTP_OK);

        } catch (\Throwable $ex) {
            return response()->json(['status' => false, 'message' => 'Sorry, something went wrong, please try again!'], Response::HTTP_BAD_REQUEST);
        }
    }

    public function reportProduct(Product $product, Request $request)
    {
        $store = $product->store;
        $reportMessage = $request->input('report_message');

        $store->user->notify(new ReportProductNotification("Reported Product: {$product->name}", $reportMessage));

        return response()->json(['message' => 'Product reported successfully']);
    }

    /**
     * @param ProductRequest $request
     * @param Product $product
     * @return void
     */
    public function saveFiles(ProductRequest $request, Product $product, $isUpdate = false): void
    {
        if ($isUpdate) {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $slug = $file->getClientOriginalName();
                $path = PhotoUpload::upload($file);
                $product->deleteImageByType('main');
                $product->storeImage($path, $slug, 'main');
            }
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $slug = $file->getClientOriginalName();
                    $path = PhotoUpload::upload($file);
                    $product->deleteImage();
                    $product->storeImage($path, $slug, 'photo');
                }
            }
        } else {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $slug = $file->getClientOriginalName();
                $path = PhotoUpload::upload($file);
                $product->storeImage($path, $slug, 'main');
            }
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $slug = $file->getClientOriginalName();
                    $path = PhotoUpload::upload($file);
                    $product->storeImage($path, $slug, 'photo');
                }
            }
        }
    }
}
