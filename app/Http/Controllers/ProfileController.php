<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('post.profile');
    }

    public function editprofile()
    {
        return view('post.editprofile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'fullname' => 'required|string|max:255',
            'bio' => 'nullable|string|max:255',
            'profile_image' => 'nullable|mimes:jpeg,png,jpg,gif',
        ]);

        $user = Auth::user();
        $user->username = $request->username;
        $user->fullname = $request->fullname;
        $user->bio = $request->bio;

        // Upload and update profile image
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = 'storage/' . $imagePath;
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
}
