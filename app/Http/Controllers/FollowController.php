<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function follow(User $user)
    {
        Auth::user()->following()->attach($user->id);

        Notification::create([
            'user_id' => auth()->id(),
            'subject_id' => $user->id,
            'post_id' => null,
            'type' => 'follow',
            'message' => 'Mengikuti anda'
        ]);

        return redirect()->back()->with('success', 'Successfully followed the user.');
    }

    public function unfollow(User $user)
    {
        Auth::user()->following()->detach($user->id);

        $user->notifications()->where('actor_id', auth()->id())->delete();

        return redirect()->back()->with('success', 'Successfully unfollowed the user.');
    }
}
