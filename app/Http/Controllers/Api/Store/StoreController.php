<?php

namespace App\Http\Controllers\Api\Store;

use App\Helpers\PhotoUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreRequest;
use App\Models\Store\Store;
use App\Models\Users\Admin;
use App\Notifications\ReportStoreNotification;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:seller')->except('index', 'store', 'show');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filters = request()->query();
        $stores = Store::with(['seller', 'regions', 'followers'])->filter($filters)->paginate();
        return response()->json(['status' => (bool)$stores, 'data' => $stores], Response::HTTP_OK);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        $store = Store::create($request->validated());
        $this->uploadFiles($request, $store);
        $store->regions()->sync($request->post('regions'));
        return response()->json(['status' => true, 'data' => $store->load('regions')], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        return $store->load(['seller', 'regions', 'followers']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Store $store)
    {
        if ($store->id !== auth()->guard('seller')->user()->store_id) {
            return response()->json(['status' => false, 'message' => 'this store belong to anther seller send right store'], Response::HTTP_BAD_REQUEST);
        }
        $this->uploadFiles($request, $store);
        $store->update($request->validated());
        return response()->json(['status' => true, 'data' => $store->load('regions')], Response::HTTP_OK);
    }


    public function reportStore(Store $store, Request $request)
    {
        $reportMessage = $request->input('report_message');

        $admin = Admin::first();
        $admin->notify(new ReportStoreNotification("Reported Store: {$store->name}", $reportMessage));

        return response()->json(['message' => 'Store reported successfully']);
    }

    /**
     * @param  $request
     * @param $store
     * @return void
     */
    public function uploadFiles($request, $store): void
    {
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $slug = $file->getClientOriginalName();
            $path = PhotoUpload::upload($file);
            $store->deleteImageByType('logo');
            $store->storeImage($path, $slug, 'logo');
        }
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $slug = $file->getClientOriginalName();
            $path = PhotoUpload::upload($file);
            $store->deleteImageByType('cover');
            $store->storeImage($path, $slug, 'cover');
        }
    }
}
