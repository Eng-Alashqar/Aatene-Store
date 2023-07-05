<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\RegionService;
use App\Http\Requests\Admin\RegionRequest;
use Symfony\Component\HttpFoundation\Response;

class RegionController extends Controller
{
    private $regionService;
    public function __construct(RegionService $regionService)
    {
        $this->regionService = $regionService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $request = request()->query();
        $count  =   request()->query('count');
        $regions = $this->regionService->get($count ?? 7, $request);
        return view('admin.regions.index', compact('regions'));
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
        $this->regionService->store($request->validated());
        return back()->with(['notification' => 'تمت العملية بنجاح']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $region = $this->regionService->getById($id);
        return view('admin.regions.edit', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RegionRequest $request, string $id)
    {
        $this->regionService->update($id, $request->validated());
        return to_route('admin.regions.index')->with(['notification' => 'تمت العملية بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isDeleted = $this->regionService->delete($id);
        return $this->deleteAjaxResponse($isDeleted);

    }
}
