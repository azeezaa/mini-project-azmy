<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\User;
use App\Models\Bookmark;
use App\Models\Notification;
use Illuminate\Support\Str;


class PostController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'for_you');
        $user = Auth::user();
        
        if ($filter === 'following') {
            $followingIds = $user->following()->pluck('users.id');
            $posts = Post::whereIn('user_id', $followingIds)->latest()->get();
        } else {
            $posts = Post::latest()->get();
        }

        $users = User::all();

        return view('welcome', compact('posts', 'users', 'filter'));
    }


    public function seePost($postId)
    {
        $post = Post::findOrFail($postId);

        return view('post.see', compact('post'));
    }

    public function explore()
    {
        $users = User::all(); 
        return view('post.explore', [
            'users' => $users instanceof Collection ? $users : collect($users),
            'isSearching' => false,
        ]);
    }

    

    public function create()
    {
        return view('post.create');
    }

   public function store(Request $request)
    {
        $request->validate([
            'caption' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('uploads', 'public');

        $post = new Post();
        $post->user_id = Auth::id();
        $post->caption = $request->caption;
        $post->image = $imagePath;
        $post->save();

        return redirect()->route('beranda')->with('success', 'Postingan berhasil dibuat.');
    }


    public function toggleBookmark($postId)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'You must be logged in to bookmark posts.');
        }

        $userId = Auth::id();
        $bookmark = Bookmark::where('user_id', $userId)
                            ->where('post_id', $postId)
                            ->first();

        if ($bookmark) {
            $bookmark->delete();
            return redirect()->back()->with('success', 'Bookmark removed successfully.');
        } else {
            Bookmark::create([
                'user_id' => $userId,
                'post_id' => $postId
            ]);
            return redirect()->back()->with('success', 'Post bookmarked successfully.');
        }
    }


    public function bookmark()
    {
        $bookmarkedPosts = Auth::user()->bookmarks()->get();

        return view('post.bookmark', compact('bookmarkedPosts'));
    }


    public function toggleLike(Post $post)
    {
        $user = Auth::user();

        if ($post->likes()->where('user_id', $user->id)->exists()) {
            $post->likes()->where('user_id', $user->id)->delete();
            $liked = false;
        } else {
            $post->likes()->create(['user_id' => $user->id]);
            $liked = true;
            Notification::create([
            'user_id' => auth()->id(),
            'subject_id' => $post->user_id,
            'post_id' => $post->id,
            'type' => 'like',
            'message' => 'Menyukai postingan anda'
        ]);
        }

        return redirect()->back();
    }
}
