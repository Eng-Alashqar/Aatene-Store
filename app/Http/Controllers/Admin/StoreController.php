<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\StoreService;
use App\Http\Requests\Admin\StoreRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreController extends Controller
{
    private $storeService;
    public function __construct(StoreService $storeService)
    {
        $this->storeService = $storeService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $request = request()->query();
        $stores = $this->storeService->get($request);
        return view('admin.stores.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::get();
        $regions = Region::get();
        return view('admin.stores.create', compact('users', 'regions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $this->storeService->store($request->validated());
        return back()->with(['notification' => 'تمت الاضافة بنجاح']);
    }

    public function pending()
    {
        $stores = $this->storeService->getPendingStores();
        return view('admin.stores.pending',compact('stores'));
    }

    public function accept($id)
    {
        $this->storeService->acceptStore($id);
        return back()->with(['notification' => 'تمت الاضافة بنجاح']);
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('admin.stores.show', [
            'store' => $this->storeService->getById($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin.stores.edit', [
            'store' => $this->storeService->getById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, $id)
    {
        $this->storeService->update($id, $request->validated());
        return to_route('admin.stores.index')->with(['notification' => 'تمت العملية بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isDeleted = $this->storeService->delete($id);
        if ($isDeleted) {
            return response()->json([
                'title' => 'تم حذف العنصر',
                'text' => 'تم حذف العنصر بنجاح',
                'icon' => 'success'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'title' => 'حدث خطأ في عملية الحذف',
                'text' => 'فشلت عملية الحذف',
                'icon' => 'error'
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
