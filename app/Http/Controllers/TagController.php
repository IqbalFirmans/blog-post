<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\TagRequest;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tags = Tag::all();


        return view('dashboard.tags.index', compact('tags'));
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
    public function store(TagRequest $request)
    {
        $validateData = $request->validated();

        $validateData['name'] = ucwords(strtolower($validateData['name']));

        try {
            Tag::create($validateData);

            return redirect()->route('tags.index')->with('success', 'Create Tag success!');
        } catch (\Throwable $e) {

            return redirect()->route('tags.index')->with('error', 'Failed create Tag.: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagRequest $request, Tag $tag)
    {
        $validateData = $request->validated();

        $validateData['name'] = ucwords(strtolower($validateData['name']));

        try {
            $tag->update($validateData);

            return redirect()->route('tags.index')->with('success', 'Update Tag success!');
        } catch (\Throwable $e) {

            return redirect()->route('tags.index')->with('error', 'Failed Update Tag.: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        if ($tag->menus()->count() > 0) {
            return redirect()->route('tags.index')->with('error', 'Cannot delete tag with associated Post.');
        }

        try {
            $tag->delete();

            return redirect()->route('tags.index')->with('success', 'Delete tag success!');
        } catch (\Throwable $e) {

            return redirect()->route('tags.index')->with('error', 'Failed Delete tag.: ' . $e->getMessage());
        }
    }
}
