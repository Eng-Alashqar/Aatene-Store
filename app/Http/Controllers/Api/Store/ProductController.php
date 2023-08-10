<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\Products\StoreProductRequest;
use App\Http\Requests\Store\Products\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Store\Product;
use App\Notifications\ReportProductNotification;
use Illuminate\Support\Facades\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = ProductResource::collection(Product::paginate());
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = new ProductResource(Product::create($request->all()));
        return response()->json($product, 201, [
            "Location" => route('products.show', $product->id),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());
        return response()->json($product, 201, [
            'location' => route('products.show', $product->id),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return ['message' => 'The product deleted successfully'];
    }

    public function reportProduct(Product $product, Request $request)
    {
        $store = $product->store;
        $reportMessage = $request->input('report_message');

        $store->user->notify(new ReportProductNotification("Reported Product: {$product->name}", $reportMessage));

        return response()->json(['message' => 'Product reported successfully']);
    }
}
