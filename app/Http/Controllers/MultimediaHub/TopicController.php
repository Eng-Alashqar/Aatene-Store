<?php

namespace App\Http\Controllers\MultimediaHub;

use App\Helpers\PhotoUpload;
use App\Http\Controllers\Controller;
use App\Models\MultimediaHub\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function create()
    {
        return view('store.topics.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:png,jpg,webm,jpeg,webp', 'max:1024576'],
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'content' => ['required', 'string', 'max:640000'],
        ]);
        $user = auth()->user();
        $topic = $user->topics()->create($request->only(['title', 'content']));
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $slug = $file->getClientOriginalName();
            $path = PhotoUpload::upload($file);
            $topic->deleteImage();
            $topic->storeImage($path, $slug, 'cover');
        }
        return back()->with(['notification', '!تم تقديم رغباتك بنجاح، شكراً جزيلاً']);
    }
}
