<?php

namespace App\Http\Controllers\Api\Users;

use App\Helpers\PhotoUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProfileRequest;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @noinspection PhpPossiblePolymorphicInvocationInspection
     */
    public function store(ProfileRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $user = auth()->user();
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $slug = $file->getClientOriginalName();
                $path = PhotoUpload::upload($file);
                $user->deleteImage();
                $user->storeImage($path, $slug, 'avatar');
            }
            $user->update([
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number
            ]);
            $user->profile()->firstOrCreate($request->only(['first_name', 'last_name', 'birthday', 'gender', 'country', 'street_address', 'city', 'state', 'postal_code', 'locale']));
        } catch (\Throwable $ex) {
            return response()->json(['status' => false, 'message' => 'Sorry, something went wrong,this user dose not exist.'], Response::HTTP_BAD_REQUEST);
        }
        return response()->json(['status' => (bool)$user, 'data' => $user->load('profile')], Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     */
    public function show(): \Illuminate\Http\JsonResponse
    {
        $user = auth()->user();
        return response()->json(['status' => (bool)$user, 'data' => $user->load('profile')], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     * @noinspection PhpPossiblePolymorphicInvocationInspection
     */
    public function update(ProfileRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $user = auth()->user();
            if ($request->has('image') && $request->hasFile('image')) {
                $file = $request->file('image');
                $slug = $file->getClientOriginalName();
                $path = PhotoUpload::upload($file);
                $user->deleteImage();
                $user->storeImage($path, $slug, 'avatar');
            }
            $user->update($request->only(['name', 'email', 'phone_number']));
            $user->profile()->update($request->only(['first_name', 'last_name', 'birthday', 'gender', 'country', 'street_address', 'city', 'state', 'postal_code', 'locale']));
        } catch (\Throwable $ex) {
            return response()->json(['status' => false, 'message' => 'Sorry, something went wrong,this user dose not exist.'], Response::HTTP_BAD_REQUEST);
        }
        return response()->json(['status' => (bool)$user, 'data' => $user->load('profile')], Response::HTTP_CREATED);

    }

    /**
     * Remove the specified resource from storage.
     * @noinspection PhpPossiblePolymorphicInvocationInspection
     */
    public function destroy(): \Illuminate\Http\JsonResponse
    {
        try {
            $user = auth()->user();
            $user->profile()->delete();
        } catch (\Throwable $ex) {
            return response()->json(['status' => false, 'message' => 'Sorry, something went wrong,this user profile dose not exist.'], Response::HTTP_BAD_REQUEST);
        }
        return response()->json(['status' => (bool)$user, 'message' => 'user profile deleted successfully', 'data' => $user->load('profile')], Response::HTTP_CREATED);

    }
}
