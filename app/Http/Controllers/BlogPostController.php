<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{

    public function index()
    {
        return view('home');
    }

    public function blog()
    {
        $posts = Post::paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function blogCategory()
    {
        $categories = Category::all();

        return view('categories', compact('categories'));
    }
}
