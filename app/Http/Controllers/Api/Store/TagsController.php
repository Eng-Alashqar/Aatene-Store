<?php

namespace App\Http\Controllers\Api\Store;

use App\Helpers\UniqueSlug;
use App\Http\Controllers\Controller;
use App\Models\MultimediaHub\Tag;
use App\Models\Store\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class TagsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:seller')->except('index');
    }

    public function index()
    {

        $filters = request()->query();
        $count = (int)request()->query('count');

        $tags = Tag::FilterApi($filters)->paginate($count == 0 ? 15 : $count);
        return response()->json(['status' => (bool)$tags, 'data' => $tags], Response::HTTP_OK);

    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:20'],
            'product_id.*' => ['required', 'int', 'exists:products,id']
        ]);
        try {
            $product = Product::findOrFail($request->product_id);
            $tag = Tag::create([
                'name' => $request->name,
            ]);
            $product->tags()->attach($tag->id);
        } catch (\Throwable $ex) {
            return response()->json(['status' => false, 'message' => 'Sorry, something went wrong,this product dose not exist.'], Response::HTTP_BAD_REQUEST);
        }

        return response()->json(['status' => (bool)$tag, 'data' => $product->tags], Response::HTTP_CREATED);

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['sometimes', 'string', 'max:20'],
        ]);
        try {
            $tag = Tag::findOrFail($id);
            $tag->update($request->only('name'));
        } catch (\Throwable $e) {
            return response()->json(['status' => false, 'message' => 'Sorry, something went wrong, please try again!'], Response::HTTP_CREATED);
        }
        return response()->json(['status' => true, 'data' => $tag], Response::HTTP_CREATED);

    }

    public function destroy($id)
    {
        try {
            $tag = Tag::findOrFail($id);
            $tag->delete();
            return response()->json(['status' => true, 'message' => 'The tag deleted successfully'], Response::HTTP_OK);

        } catch (\Throwable $ex) {
            return response()->json(['status' => false, 'message' => 'Sorry, something went wrong, please try again!'], Response::HTTP_BAD_REQUEST);
        }
    }
}
