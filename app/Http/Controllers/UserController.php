<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
     public function index()
    {
        // Fetch users from the database
        $users = User::all();

        // Pass users data to the view
        return view('welcome', ['users' => $users]);
    }

    public function follow(User $userToFollow)
    {
        auth()->user()->following()->attach($userToFollow->id);
        $userToFollow->followers()->attach(auth()->user()->id);
        
        return back()->with('success', 'You are now following ' . $userToFollow->username);
    }

    public function unfollow(User $userToUnfollow)
    {
        auth()->user()->following()->detach($userToUnfollow->id);
        $userToUnfollow->followers()->detach(auth()->user()->id);
        
        return back()->with('success', 'You have unfollowed ' . $userToUnfollow->username);
    }

}
