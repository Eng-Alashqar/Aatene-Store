<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Loyalty\Follower;
use App\Models\Store\Store;

class FollowerController extends Controller
{
    public function follow(Store $store)
    {
        $user = auth()->user;
        // $user = User::find(1);

        // Check if the user is not already following the store
        if (!$user->followers()->where('store_id', $store->id)->exists()) {
            $follower = new Follower([
                'user_id' => $user->id,
                'store_id' => $store->id
            ]);
            $follower->save();
            return response()->json(['message' => 'You are now following the store.']);
        }

        return response()->json(['message' => 'You are already following the store.']);
    }

    public function unfollow(Store $store)
    {
        $user = auth()->user;
        // $user = User::find(1);

        // Find the follower entry and delete it if it exists
        $follower = $user->followers()->where('store_id', $store->id)->first();

        if ($follower) {
            $follower->delete();
            return response()->json(['message' => 'You have unfollowed the store.']);
        }

        return response()->json(['message' => 'You were not following the store.']);
    }

    public function followersList(Store $store)
    {
        $followers = $store->followers;

        return response()->json(['followers' => $followers]);
    }
}
