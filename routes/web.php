<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;


Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'store']);

Route::get('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');


Route::post('/image', [ImageController::class, 'store'])->name('image.store');

Route::get('/create', [PostController::class, 'create'])->name('post.create')->middleware('auth');
Route::post('/create', [PostController::class, 'store'])->name('post.store');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');
Route::get('{user}/post/{post}', [PostController::class, 'show'])->name('post.show');
Route::get('post/edit/{post}', [PostController::class, 'edit'])->name('post.edit');
Route::put('post/update/{post}', [PostController::class, 'update'])->name('post.update');
Route::delete('post/delete/{post}', [PostController::class, 'destroy'])->name('post.destroy');

Route::post('post/{post}/comment', [CommentController::class, 'store'])->name('comment.store');
Route::delete('comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');


Route::get('categories/{category:name}', [CategoryController::class, 'show'])->name('category.show');

Route::get('profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
Route::get('profile/edit/{user}', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('profile/update/{user}', [ProfileController::class, 'update'])->name('profile.update');

