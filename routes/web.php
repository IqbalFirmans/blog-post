<?php

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReportController;

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::resource('posts', PostController::class);
    Route::resource('comments', CommentController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('reports', ReportController::class);

    Route::post('bookmarks/{post}', [BookmarkController::class, 'store'])->name('bookmarks.store');

    Route::get('blog/bookmarks', [BookmarkController::class, 'blogBookmark'])->name('blog.bookmark');
});

Route::get('', [BlogPostController::class, 'index'])->name('home');
Route::get('blog', [BlogPostController::class, 'blog'])->name('blog');
Route::get('blog/category', [BlogPostController::class, 'blogCategory'])->name('blog.category');
