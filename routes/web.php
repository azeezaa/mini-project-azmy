<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\FollowController;

Route::get('/', [PostController::class, 'index'])->name('beranda');

// Authentication
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/explorePeople', [PostController::class, 'explore'])->name('explore');

Route::middleware('auth')->group(function () {
    // Post
    Route::get('/seePost/{postId}', [PostController::class, 'seePost'])->name('seePost');
    Route::get('/post/create', [PostController::class, 'create'])->name('createPost');
    Route::post('/post', [PostController::class, 'store'])->name('storePost');
    Route::post('/post/{id}/like', [PostController::class, 'likePost'])->name('likePost');
    Route::post('/posts/{post}/toggle-like', [PostController::class, 'toggleLike'])->name('toggleLike');
    Route::get('/bookmark', [PostController::class, 'bookmark'])->name('bookmark');
    Route::post('/toggle-bookmark/{postId}', [PostController::class, 'toggleBookmark'])->name('toggleBookmark');

    // Profile
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/edit-profile', [ProfileController::class, 'editprofile'])->name('editprofile');
    Route::post('/update-profile', [ProfileController::class, 'updateProfile'])->name('profile.update');


    // Comment
    Route::post('/addComment/{post}', [CommentController::class, 'addComment'])->name('addComment');
    Route::delete('/comment/{commentId}', [CommentController::class, 'deleteComment'])->name('deleteComment');
    Route::post('/comment/{commentId}/toggle-comment', [CommentController::class, 'toggleCommentLike'])->name('toggleCommentLike');
    Route::post('/comment/{commentId}/reply', [CommentController::class, 'replyComment'])->name('replyComment');


    // User, Follows, Search
    Route::post('/follow/{id}', [UserController::class, 'follow'])->name('follow');
    Route::post('/unfollow/{id}', [UserController::class, 'unfollow'])->name('unfollow');
    Route::post('/follow/{user}', [UserController::class, 'follow'])->name('follow');
    Route::post('/unfollow/{user}', [UserController::class, 'unfollow'])->name('unfollow');
    
    
    // Notifikasi
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/comments', [NotificationController::class, 'comments'])->name('notifications.comments');
    Route::get('/notifications/likes', [NotificationController::class, 'likes'])->name('notifications.likes');
    Route::get('/search', [UserController::class, 'search'])->name('search');
});
