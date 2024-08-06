<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::withCount('posts')->get();

        return view('dashboard.categories.index', compact('categories'));
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
    public function store(CategoryRequest $request)
    {
        $validateData = $request->validated();

        $validateData['name'] = ucwords(strtolower($validateData['name']));

        try {
            Category::create($validateData);

            return redirect()->route('categories.index')->with('success', 'Create Category success!');
        } catch (\Throwable $e) {

            return redirect()->route('categories.index')->with('error', 'Failed create category.: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $validateData = $request->validated();

        $validateData['name'] = ucwords(strtolower($validateData['name']));

        try {
            $category->update($validateData);

            return redirect()->route('categories.index')->with('success', 'Update Category success!');
        } catch (\Throwable $e) {

            return redirect()->route('categories.index')->with('error', 'Failed Update category.: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->posts()->count() > 0) {
            return redirect()->route('categories.index')->with('error', 'Cannot delete Category with associated Post.');
        }

        try {
            $category->delete();

            return redirect()->route('categories.index')->with('success', 'Delete Category success!');
        } catch (\Throwable $e) {

            return redirect()->route('categories.index')->with('error', 'Failed Delete category.: ' . $e->getMessage());
        }
    }
}
