<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\FaqsRequest;
use App\Models\MultimediaHub\Faqs;

class FaqsController extends Controller
{
    public function __construct(private Faqs $faqs) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $params = request()->query();
        $count = (int) request()->query('count');
        $count == 0 ? $count = 7 : '';
        $faqs = $this->faqs->latest()->filter($params)->paginate($count);
        return view('admin.faqs.index',compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FaqsRequest $request)
    {
        $this->faqs->create($request->validated());
        return back()->with(['notification'=>'تمت العملية بنجاح']);
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
        $faqs = $this->faqs->findOrFail($id);
        return view('admin.faqs.edit',compact('faqs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FaqsRequest $request,$id)
    {
        $faqs = $this->faqs->findOrFail($id);
        $faqs->update($request->validated());
        return to_route('admin.faqs.index')->with(['notification'=>'تمت العملية بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isDeleted = $this->faqs->find($id)->delete();
        return $this->deleteAjaxResponse($isDeleted);
    }
}
