<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('store.topics.create');
    }

    public function store(Request $request, Topic $topic)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'content' => ['nullable', 'string'],
        ], [
            'title.required' => 'يرجى كتابة عنوان للموضوع',
            'title.string' => 'يجب أن يكون العنوان نصاً',
            'title.min' => 'كتابة عنوان يتكون على الاقل من ثلاثة احرف',
            'title.max' => 'الحدد الأقصى للحروف اللازمة لكتابة عنوان 255 حرفاً',
            'content' => 'يجب احتواء الموضوع على نص'
        ]);
        $request->merge(['user_id' => auth()->user()->id]);
        $topic->create($request->all());
        return redirect()->back()->with(['notification', '!تم تقديم رغباتك بنجاح، شكراً جزيلاً']);
    }
}
