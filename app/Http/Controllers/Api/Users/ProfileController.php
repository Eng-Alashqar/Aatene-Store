<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles = Profile::latest()->get();
        return response()->json($profiles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfileController $request)
    {
        $profile = Profile::create($request->vaildated());
        return response()->json($profile, 200, [
            'location' => route('profiles.show', $profile->id)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        return response()->json($profile);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileController $request, Profile $profile)
    {
        $updatedProfile = $profile->update($request->all());
        return response()->json($updatedProfile, 201, [
            'location' => route('profiles.show', $profile->id)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
