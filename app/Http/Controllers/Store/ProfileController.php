<?php

namespace App\Http\Controllers\Store;

use App\Helpers\PhotoUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\User\ProfileRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    public function index()
    {
        return view('store.profile.index', ['user' => auth()->user()->load('profile')]);
    }

    public function edit()
    {
        return view('store.profile.edit', ['user' => auth()->user()->load('profile')]);
    }

    public function update(ProfileRequest $request)
    {
        try {
            $user = auth()->user();
            if ($request->has('avatar') && $request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $slug = $file->getClientOriginalName();
                $path = PhotoUpload::upload($file);
                $user->deleteImage();
                $user->storeImage($path, $slug, 'avatar');
            }
            $user->update(['name' => $request->first_name . $request->last_name]);
            $user->profile()->update($request->only(['first_name', 'last_name', 'birthday', 'gender', 'country', 'street_address', 'city', 'state', 'postal_code', 'locale']));
        } catch (\Throwable $ex) {
            return back()->with(['notification' => 'Sorry, something went wrong,this user dose not exist.']);
        }
        return to_route('dashboard.profile.index')->with(['notification' => 'تم تعديل الملف الشخصي بنجاح']);

    }
}
