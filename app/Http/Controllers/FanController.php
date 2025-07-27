<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FanController extends Controller
{
    public function follow($userId)
    {
        $fan = Auth::user();
        $userToFollow = User::findOrFail($userId);

        if ($fan->id === $userToFollow->id) {
            return response()->json(['message' => 'You cannot follow yourself'], 400);
        }

        if (!$userToFollow->fans()->where('fan_id', $fan->id)->exists()) {
            $userToFollow->fans()->attach($fan->id);
            return response()->json(['message' => 'You are now following ' . $userToFollow->name]);
        }

        return response()->json(['message' => 'Already following this user.']);
    }

    public function unfollow($userId)
    {
        $fan = Auth::user();
        $userToUnfollow = User::findOrFail($userId);

        $userToUnfollow->fans()->detach($fan->id);

        return response()->json(['message' => 'You have unfollowed ' . $userToUnfollow->name]);
    }
}
