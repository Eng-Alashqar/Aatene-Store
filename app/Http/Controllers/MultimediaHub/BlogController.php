<?php

namespace App\Http\Controllers\MultimediaHub;

use App\Http\Controllers\Controller;
use App\Http\Requests\MultimediaHub\BlogRequest;
use App\Models\MultimediaHub\Blog;
use App\Services\MultimediaHub\BlogService;

class BlogController extends Controller
{
    public function __construct(private BlogService $blogService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = $this->blogService->get($count??7);
        return view('store.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('store.blogs.create', [
            'blog' => new Blog()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        $this->blogService->store($request->validated());
        return redirect()->back()->with(['notification' => 'تم إنشاء مدونة بنجاح']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('store.blogs.show', [
            'category' => $this->blogService->getById($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin.blogs.edit', [
            'blog' => $this->blogService->getById($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, $id)
    {
        $this->blogService->update($id, $request->validated());
        return redirect()->route('admin.blogs.index')->with(['notification' => 'تم تحديث المدونة']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $isDeleted = $this->blogService->delete($id);
        return  $this->deleteAjaxResponse($isDeleted);
    }
}
