<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Post;

class NotificationController extends Controller
{

    public function index()
    {
        $notifications = Notification::all();
        return view('notification', compact('notifications'));
    }

    public function comments()
{
    $notifications = Notification::where('message', 'like', '%mengomentari%')->get();
    return view('notification', compact('notifications'));
}

public function likes()
{
    $notifications = Notification::where('message', 'like', '%menyukai%')->get();
    return view('notification', compact('notifications'));
}


}
