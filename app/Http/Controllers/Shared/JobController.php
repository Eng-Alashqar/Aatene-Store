<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shared\JobRequest;
use App\Models\Job;
use App\Services\Shared\JobService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JobController extends Controller
{
    public function __construct(private JobService $jobService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('store.jobs.index', [
            'jobs' => $this->jobService->get()
        ]);
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
     */
    public function store(JobRequest $request)
    {
        $this->jobService->store($request->validated());
        return redirect()->back()->with(['notification' => 'تم اضافة وظيفة جديدة بنجاح']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        return view('store.jobs.show', ['job' => $this->jobService->getById($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('store.jobs.edit', [
            'job' => $this->jobService->getById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->jobService->update($id, $request->validated);
        return redirect()->back()->with(['notification' => 'تم تعديل بينانات المنتج بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isDeleted = $this->jobService->delete($id);
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
