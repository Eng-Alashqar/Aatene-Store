<?php

namespace App\Http\Controllers\MultimediaHub;

use App\Helpers\PhotoUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\MultimediaHub\BlogRequest;
use App\Models\MultimediaHub\Blog;
use App\Services\MultimediaHub\BlogService;

class BlogController extends Controller
{
    public function __construct(private Blog $model){}
    /**
     * Display a listing of the resource.
     * @noinspection PhpUndefinedMethodInspection
     */
    public function index()
    {
        $filters = request()->query();
        $count = (int)request()->query('count') == 0 ? 7 : (int)request()->query('count') ;
        $blogs = $this->model->latest()->filter($filters)->paginate($count);
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
        $jop = $this->model->create($request->validated());
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $slug = $file->getClientOriginalName();
            $path = PhotoUpload::upload($file);
            $jop->deleteImage();
            $jop->storeImage($path, $slug, 'cover');
        }
        return back()->with(['notification' => 'تم إنشاء مدونة بنجاح']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('store.blogs.show', [
            'blog' => $this->model->findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('store.blogs.edit', [
            'blog' =>  $this->model->findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, $id)
    {
        $blog = $this->model->findOrFail($id);
        $blog->update($request->validated());
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $slug = $file->getClientOriginalName();
            $path = PhotoUpload::upload($file);
            $blog->deleteImage();
            $blog->storeImage($path, $slug, 'cover');
        }
        return to_route('dashboard.blogs.index')->with(['notification' => 'تمت العملية بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $blog = $this->model->findOrFail($id);
        $isDeleted = $blog->delete();
        return $this->deleteAjaxResponse($isDeleted);
    }
}
