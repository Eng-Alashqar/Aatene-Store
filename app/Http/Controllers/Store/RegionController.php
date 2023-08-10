<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\RegionRequest;
use App\Models\Region;
use App\Services\Store\RegionService;

class RegionController extends Controller
{
    private $region;
    public function __construct()
    {
        $this->region = new Region;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filters = request()->query();
        $count  =  (int) request()->query('count') ?? 7;
        $regions = $this->region->latest()->filter($filters)->paginate( $count);
        return view('admin.regions.index', compact('regions'));
    }

    public function all()
    {
        return $this->region->all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.regions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegionRequest $request)
    {
        $this->region->create($request->validated());
        return back()->with(['notification' => 'تمت العملية بنجاح']);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $region = $this->region->findOrFail($id);
        return view('admin.regions.edit', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RegionRequest $request, string $id)
    {
        $region = $this->region->findOrFail($id);
        $region->update($request->validated());
        return to_route('admin.regions.index')->with(['notification' => 'تمت العملية بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $region = $this->region->findOrFail($id);
        $isDeleted = $region->delete($id);
        return $this->deleteAjaxResponse($isDeleted);
    }
}
