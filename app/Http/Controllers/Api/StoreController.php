<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRequest;
use App\Http\Resources\StoreResourse;
use App\Models\Store;
use App\Models\Admin;

use Illuminate\Http\Request;
use App\Notifications\ReportStoreNotification;


class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = StoreResourse::collection(Store::all());
        return response()->json($stores);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $store = new StoreResourse(Store::create($request->all()));
        return response()->json($store, 201, [
            "Location" => route('stores.show', $store->id),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        return new StoreResourse($store);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Store $store)
    {
        $store->update($request->all());
        return response()->json($store, 201, [
            "Location" => route('stores.show', $store->id),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return;
    }

    public function reportStore(Store $store, Request $request)
    {
        $reportMessage = $request->input('report_message');

        $admin = Admin::first();
        $admin->notify(new ReportStoreNotification("Reported Store: {$store->name}", $reportMessage));

        return response()->json(['message' => 'Store reported successfully']);
    }
}
