<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogPostController extends Controller
{

    public function index()
    {
        $postCount = Post::count();
        $categoryCount = Category::count();
        $authorCount = User::count();
        $user = Auth::user();

        return view('home', compact('postCount', 'categoryCount', 'authorCount', 'user'));
    }

    public function blog(Request $request)
    {

        $title = 'All Posts';
        if (request('category')) {
            $category  = Category::firstWhere('name', request('category'));

            if ($category) {
                $title .= ' in ' . $category->name;
            } else {
                return redirect()->route('blog')->with('error', 'Category not Found.');
            }
        }

        if (request('author')) {
            $author = User::firstWhere('name', request('author'));

            if ($author) {
                $title .= ' by ' . $author->name;
            } else {
                return redirect()->route('blog')->with('error', 'Author not Found.');
            }
        }

        $posts = Post::filter(request(['category', 'author']))->paginate(7)->withQueryString();

        return view('posts.index', compact('posts', 'title'));
    }

    public function blogCategory()
    {
        $categories = Category::all();

        return view('categories', compact('categories'));
    }
}
