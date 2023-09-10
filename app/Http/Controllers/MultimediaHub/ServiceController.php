<?php

namespace App\Http\Controllers\MultimediaHub;

use App\Helpers\PhotoUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\MultimediaHub\ServiceRequest;
use App\Models\MultimediaHub\Service;

class ServiceController extends Controller
{
    public function __construct(private Service $model)
    {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filters = request()->query();
        $count = (int)request()->query('count');
        $services = $this->model->latest()->filter($filters)->paginate($count == 0 ? 7 : $count);
        return view('store.services.index', compact('services'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('store.services.create', [
            'service' => new Service()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        $service = $this->model->create($request->validated());
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $slug = $file->getClientOriginalName();
            $path = PhotoUpload::upload($file);
            $service->deleteImage();
            $service->storeImage($path, $slug, 'cover');
        }
        return back()->with(['notification' => 'تم اضافة خدمة جديدة بنجاح']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('store.services.show', ['product' => $this->model->findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('store.services.edit', [
            'service' => $this->model->findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $request, $id)
    {
        $service = $this->model->findOrFail($id);
        $service->update($request->validated());
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $slug = $file->getClientOriginalName();
            $path = PhotoUpload::upload($file);
            $service->deleteImage();
            $service->storeImage($path, $slug, 'cover');
        }
        return to_route('dashboard.services.index')->with(['notification' => 'تمت العملية بنجاح']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $service = $this->model->findOrFail($id);
        $isDeleted = $service->delete();
        return $this->deleteAjaxResponse($isDeleted);
    }
}
