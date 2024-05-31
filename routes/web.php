<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'index'])->name('beranda');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/seePost', [PostController::class, 'seePost'])->name('seePost');
Route::get('/explorePeople', [PostController::class, 'explore'])->name('explore');

Route::get('/profile', [PostController::class, 'profile'])->name('profile');
Route::post('/update-profile', [PostController::class, 'updateProfile'])->name('profile.update');
Route::get('/edit-profile', [PostController::class, 'editprofile'])->name('editprofile');

Route::get('/formPost', [PostController::class, 'formPost'])->name('formPost');
Route::get('/bookmark', [PostController::class, 'bookmark'])->name('bookmark');

Route::post('/follow/{id}', [UserController::class, 'follow'])->name('follow');
Route::post('/unfollow/{id}', [UserController::class, 'unfollow'])->name('unfollow');