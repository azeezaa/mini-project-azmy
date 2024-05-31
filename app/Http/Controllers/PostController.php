<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function beranda()
    {
        return view('welcome');
    }

    public function seePost()
    {
        return view('post.see');
    }

    public function explore()
    {
        return view('post.explore');
    }

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
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        $user = Auth::user();
        $user->username = $request->username;
        $user->fullname = $request->fullname;
        $user->bio = $request->bio;

        // Upload and update profile image
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profile_images', 'public'); // Store image in storage/app/public/profile_images
            $user->profile_image = 'storage/' . $imagePath;
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }


    public function formPost()
    {
        return view('post.form');
    }

    public function bookmark()
    {
        return view('post.bookmark');
    }
}
