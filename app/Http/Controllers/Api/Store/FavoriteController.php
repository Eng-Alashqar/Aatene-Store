<?php

namespace App\Http\Controllers\Api\Store;

use App\Http\Controllers\Controller;
use App\Http\Resources\FavoriteResource;
use App\Models\Store\Favorite;
use App\Models\Users\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->guard('user')->user();
        $favorites = $user->favorites()->get();
        return response()->json($favorites);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id'=>['int','exists:products,id']
        ]);
        $user = auth()->guard('user')->user();
        $favorite = Favorite::firstOrcreate([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
        ]);
        return response()->json(['status'=>(bool)$favorite,'message' => (bool)$favorite ? 'Product added to favorites' :  'Sorry, something went wrong, please try again!'],(bool)$favorite ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,  $id)
    {
         $user = $request->user();
        try {
            $favorite = Favorite::findOrFail($id);

            if ($favorite->user_id !== $user->id) {
                return response()->json(['message' => 'Unauthorized'], Response::HTTP_FORBIDDEN);
            }
            $favorite->delete();
            return response()->json( ['status'=>true,'message' => 'The product deleted successfully'],Response::HTTP_OK);

        }catch (\Throwable $ex){
            return response()->json(['status'=>false,'message'=>'Sorry, something went wrong, please try again!'], Response::HTTP_BAD_REQUEST);
        }


        $favorite->delete();

        return response()->json(['message' => 'Product removed from favorites']);
    }
}
