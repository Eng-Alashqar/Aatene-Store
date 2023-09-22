<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\CategoryRequest;
use App\Services\Store\CategoryService;

class CategoryController extends Controller
{
    private $categoryService;
    public function __construct() {
        $this->categoryService = new CategoryService;
    }
    public function index()
    {
        $categories = $this->categoryService->get();
        return view('admin.categories.index',compact('categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->getParentCategories();
        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Category a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $this->categoryService->store($request->validated());
        return back()->with(['notification' => 'تمت الاضافة بنجاح']);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('admin.categories.show', [
            'category' => $this->categoryService->getById($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin.categories.edit', [
            'category' => $this->categoryService->getById($id),
            'categories' => $this->categoryService->getParentCategories()->where('id','<>',$id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, $id)
    {
        $this->categoryService->update($id, $request->validated());
        return to_route('admin.categories.index')->with(['notification' => 'تمت العملية بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isDeleted = $this->categoryService->delete($id);
        return $this->deleteAjaxResponse($isDeleted);
    }
}
