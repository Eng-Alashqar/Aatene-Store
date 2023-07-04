<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\CategoryService;
use App\Http\Requests\Admin\CategoryRequest;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    private $categoryService;
    public function __construct(CategoryService $categoryService) {
        $this->categoryService = $categoryService;
    }
    public function index()
    {
        $request = request()->query();
        $count = request()->query('count');
        $categories = $this->categoryService->get($count??7,$request);
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
            'categories' => $this->categoryService->getParentCategories()

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
