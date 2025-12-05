<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.newpost');
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
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'brief_description' => 'nullable|string',
            'markdown' => 'required|string',
            'tags' => 'nullable',
            'tags.*' => 'string',
            'difficulty' => 'required|integer|min:1|max:3',
            'thumbnail' => 'nullable|image|max:2048'
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = \Illuminate\Support\Facades\Storage::disk('public')->put('thumbnails', $request->file('thumbnail'));
        }

        $post = Post::create([
            'title' => $request->title,
            'brief_description' => $request->brief_description,
            'content' => $request->markdown,
            'tags' => $request->tags ? json_encode($request->tags) : null,
            'difficulty' => $request->difficulty,
            'thumbnail' => $thumbnailPath,
            'author_id' => auth()->id(),
            'likes' => 0,
            'comments' => 0,
            'views' => 0,
            'upvote' => 0,
            'downvote' => 0,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
