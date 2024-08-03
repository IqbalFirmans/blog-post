<?php

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CategoryController;



Auth::routes();

Route::middleware('auth')->group(function () {
    Route::resource('posts', PostController::class);
    Route::resource('comments', CommentController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
});

Route::get('', [BlogPostController::class, 'index'])->name('home');
Route::get('blog', [BlogPostController::class, 'blog'])->name('blog');
Route::get('blog/category', [BlogPostController::class, 'blogCategory'])->name('blog.category');
