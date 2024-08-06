<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::user()->id)->paginate(10);

        $categories = Category::all();

        return view('dashboard.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $validateData = $request->validated();

        try {
            $validateData['image'] = $request->file('image')->store('post-images');

            $validateData['user_id'] = Auth::user()->id;

            Post::create($validateData);


            return redirect()->route('posts.index')->with('success', 'Create Post Success!');
        } catch (\Throwable $e) {

            return redirect()->route('posts.index')->with('success', 'Failed Create Post.' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.    
     */
    public function update(PostRequest $request, Post $post)
    {
        $validateData = $request->validated();

        try {
            if ($request->hasFile('image')) {

                if ($post->image) {
                    Storage::delete($post->image);
                }

                $validateData['image'] = $request->file('image')->store('post-images');
            }

            $post->update($validateData);

            return redirect()->route('posts.index')->with('success', 'Update Post Success!');
        } catch (\Throwable $e) {

            return redirect()->route('posts.index')->with('success', 'Failed Update Post.' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        try {
            if ($post->image) {
                Storage::delete($post->image);
            }

            $post->delete();

            return redirect()->route('posts.index')->with('success', 'Delete Post Success!');
        } catch (\Throwable $e) {

            return redirect()->route('posts.index')->with('success', 'Failed Delete Post.' . $e->getMessage());
        }
    }
}
