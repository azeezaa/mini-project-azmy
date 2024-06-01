<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
     public function index()
    {
        $users = User::all();

        return view('welcome', ['users' => $users]);
    }

    public function follow($userId)
    {
        $userToFollow = User::findOrFail($userId);
        auth()->user()->following()->attach($userToFollow->id);

        return back()->with('success', 'You are now following ' . $userToFollow->username);
    }

    public function unfollow($userId)
    {
        $userToUnfollow = User::findOrFail($userId);
        auth()->user()->following()->detach($userToUnfollow->id);

        return back()->with('success', 'You have unfollowed ' . $userToUnfollow->username);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $result = User::query()
            ->where('username', 'like', "%$query%")
            ->orWhere('fullname', 'like', "%$query%")
            ->get();
            $users = User::all();

        $isSearching = !empty($query);

        return view('post.explore', compact('result','users', 'isSearching'));
    }

}
