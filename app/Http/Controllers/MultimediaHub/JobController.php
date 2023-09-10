<?php

namespace App\Http\Controllers\MultimediaHub;

use App\Helpers\PhotoUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\MultimediaHub\JobRequest;
use App\Models\MultimediaHub\Job;
use App\Services\MultimediaHub\JobService;
use Symfony\Component\HttpFoundation\Response;

class JobController extends Controller
{
    public function __construct(private Job $model)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filters = request()->query();
        $count = (int)request()->query('count') ;
        $jobs = $this->model->latest()->filter($filters)->paginate($count == 0 ? 7 : $count);
        return view('store.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('store.jobs.create', ['job' => new Job()]);
    }

    /**
     * Store a newly created resource in storage.
     * @noinspection PhpUndefinedMethodInspection
     */
    public function store(JobRequest $request): \Illuminate\Http\RedirectResponse
    {
        $jop = $this->model->create($request->validated());
        if ($request->hasFile('company_logo')) {
            $file = $request->file('company_logo');
            $slug = $file->getClientOriginalName();
            $path = PhotoUpload::upload($file);
            $jop->deleteImage();
            $jop->storeImage($path, $slug, 'logo');
        }
        return back()->with(['notification' => 'تم اضافة وظيفة جديدة بنجاح']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('store.jobs.show', ['job' => $this->model->findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('store.jobs.edit', [
            'job' => $this->model->findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @noinspection PhpUndefinedMethodInspection
     */
    public function update(JobRequest $request, string $id): \Illuminate\Http\RedirectResponse
    {
        $jop = $this->model->findOrFail($id);
        $jop->update($request->validated());
        if ($request->hasFile('company_logo')) {
            $file = $request->file('company_logo');
            $slug = $file->getClientOriginalName();
            $path = PhotoUpload::upload($file);
            $jop->deleteImage();
            $jop->storeImage($path, $slug, 'logo');
        }
        return to_route('dashboard.jobs.index')->with(['notification' => 'تمت العملية بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     * @noinspection PhpUndefinedMethodInspection
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        $job = $this->model->findOrFail($id);
        $isDeleted = $job->delete();
        return $this->deleteAjaxResponse($isDeleted);

    }
}
