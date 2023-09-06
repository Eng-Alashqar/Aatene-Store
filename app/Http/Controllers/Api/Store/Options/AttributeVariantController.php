<?php

namespace App\Http\Controllers\Api\Store\Options;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class AttributeVariantController extends Controller
{
    /** @noinspection PhpPossiblePolymorphicInvocationInspection */
    public function store(Request $request)
    {
        $request->validate([
            'attribute_id' => ['required', 'int', 'exists:attributes,id'],
            'variant_id' => ['required', 'int', 'exists:variants,id']
        ]);
        try {
            $option = DB::table('attributes_variants')->updateOrInsert($request->only(['attribute_id', 'variant_id']));
//            $option = DB::insert("insert into attributes_variants (attribute_id, variant_id) values (?, ?)", [$request->attribute_id, $request->variant_id]);
        } catch (\Throwable $ex) {
            return response()->json(['status' => false, 'message' => 'Sorry, something went wrong.'], Response::HTTP_BAD_REQUEST);
        }
        return response()->json(['status' => (bool)$option, 'data' => $request->only(['attribute_id', 'variant_id'])], Response::HTTP_CREATED);
    }


}
