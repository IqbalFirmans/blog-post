<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function index()
    {
        //
    }

    public function blogBookmark()
    {
        $bookmarks = Auth::user()->bookmarks()->with('post')->get();

        return view('bookmarks', compact('bookmarks'));
    }

    public function store(Post $post)
    {
        $user = Auth::user();
        $bookmark = $user->bookmarks()->where('post_id', $post->id)->first();

        try {
            if ($bookmark) {

                // hapus bookmark jika sudah ada
                $bookmark->delete();

                return redirect()->back()->with('success', 'Remove bookmark success!');
            } else {

                // tambah bookmark jika belum ada
                $user->bookmarks()->create([
                    'post_id' => $post->id
                ]);

                return redirect()->back()->with('success', 'Add bookmark success!');
            }
        } catch (\Throwable $e) {

            return redirect()->back()->with('error', 'Failed add bookmark. ' . $e->getMessage());
        }
    }
}
