<?php

namespace App\Http\Controllers\Api\Store\Options;

use App\Helpers\PhotoUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Store\Options\VariantRequest;
use App\Models\Store\Product;
use App\Models\Store\Variant;
use Symfony\Component\HttpFoundation\Response;

class VariantsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:seller')->except('index');
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        $variant = Variant::find($id);
        return response()->json(['status' => (bool)$variant, 'data' => $variant], Response::HTTP_OK);


    }
    /** @noinspection PhpUndefinedMethodInspection
     * @noinspection PhpUndefinedFieldInspection
     */
    public function store(VariantRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $product = Product::findOrFail($request->product_id);
            $variant = Variant::create($request->validated());
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $slug = $file->getClientOriginalName();
                $path = PhotoUpload::upload($file);
                $variant->deleteImage();
                $variant->storeImage($path, $slug, 'variant_photo');
            }
        } catch (\Throwable $ex) {
            return response()->json(['status' => false, 'message' => 'Sorry, something went wrong,this product dose not exist.'], Response::HTTP_BAD_REQUEST);
        }
        return response()->json(['status' => (bool)$variant, 'data' => $variant], Response::HTTP_CREATED);
    }

    /** @noinspection PhpMissingReturnTypeInspection
     * @noinspection PhpUndefinedMethodInspection
     * @noinspection PhpUndefinedFieldInspection
     */
    public function update(VariantRequest $request, $id)
    {
        try {
            $variant = Variant::findOrFail($id);
            $variant->update($request->validated());
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $slug = $file->getClientOriginalName();
                $path = PhotoUpload::upload($file);
                $variant->deleteImage();
                $variant->storeImage($path, $slug, 'variant_photo');
            }
        } catch (\Throwable $ex) {
            return response()->json(['status' => false, 'message' => 'Sorry, something went wrong,this product dose not exist.'], Response::HTTP_BAD_REQUEST);
        }
        return response()->json(['status' => (bool)$variant, 'data' => $variant], Response::HTTP_CREATED);
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        try {
            $variant = Variant::findOrFail($id);
            $variant->delete();
            return response()->json(['status' => true, 'message' => 'The variant deleted successfully'], Response::HTTP_OK);

        } catch (\Throwable $ex) {
            return response()->json(['status' => false, 'message' => 'Sorry, something went wrong, please try again!'], Response::HTTP_BAD_REQUEST);
        }
    }


}
