<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// the home page just sends people to the post list
Route::redirect('/', '/posts');

// login and logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// posts
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
// create must come before {id}, or "create" is read as an id
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth');
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

// author page
Route::get('/authors/{author}', [AuthorController::class, 'show'])->name('authors.show');