<?php

namespace App\Http\Controllers\API\Store;

use App\Http\Controllers\Controller;
use App\Models\Loyalty\Follower;
use App\Models\Store\Store;

class FollowerController extends Controller
{
    public function follow(Store $store)
    {
        $user = auth()->guard('user')->user();

        // Check if the user is not already following the store
        if (!$user->followers()->where('store_id', $store->id)->exists()) {
            $follower = new Follower([
                'user_id' => $user->id,
                'store_id' => $store->id
            ]);
            $follower->save();
            return response()->json(['status'=>true,'message' => 'You are now following the store.']);
        }

        return response()->json(['message' => 'You are already following the store.']);
    }

    public function unfollow(Store $store)
    {
        $user = auth()->guard('user')->user();

        // Find the follower entry and delete it if it exists
        $follower = $user->followers()->where('store_id', $store->id)->first();

        if ($follower) {
            $follower->delete();
            return response()->json(['message' => 'You have unfollowed the store.']);
        }

        return response()->json(['message' => 'You were not following the store.']);
    }

    public function followersList()
    {
        $followers = auth()->guard('seller')->user()->followers;

        return response()->json(['followers' => $followers]);
    }
}
