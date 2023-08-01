<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\FavoriteResource;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $user = $request->user();
        // $favorites = $user->favorites()->get();
        $user = User::find(11);
        $favorites = $user->favorites;

        return response()->json(FavoriteResource::collection($favorites));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $user = $request->user();
        $favorite = new Favorite([
            'user_id' => $request->input('user_id'),
            'product_id' => $request->input('product_id'),
        ]);
        $favorite->save();
        return response()->json(['message' => 'Product added to favorites']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Favorite $favorite)
    {
        // $user = $request->user();

        // if ($favorite->user_id !== $user->id) {
        //     return response()->json(['message' => 'Unauthorized'], 403);
        // }

        $favorite->delete();

        return response()->json(['message' => 'Product removed from favorites']);
    }
}
