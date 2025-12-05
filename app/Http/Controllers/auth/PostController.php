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
    public function show(Post $post)
    {
        $post->tags = json_decode(json_decode($post->tags), true); // Keep original double decode if that's how it was stored
        $post->increment('views');

        $userVote = null;
        if (auth()->check()) {
            $userVote = $post->votes()->where('user_id', auth()->id())->first();
        }

        return view('guest.post', compact('post', 'userVote'));
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

    public function vote(Request $request, Post $post)
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }
        $request->validate([
            'vote' => 'required|in:1,-1,0',
        ]);

        $user = auth()->user();
        $voteValue = (int) $request->vote;

        $postVote = $post->votes()->firstOrCreate(
            ['user_id' => $user->id],
            ['liked' => false, 'vote' => 0]
        );

        // If clicking the same vote again, toggle it off (set to 0)
        if ($postVote->vote === $voteValue) {
            $voteValue = 0;
        }

        // Update counts on Post model
        // First revert old vote
        if ($postVote->vote === 1)
            $post->decrement('upvote');
        elseif ($postVote->vote === -1)
            $post->decrement('downvote');

        // Apply new vote
        if ($voteValue === 1)
            $post->increment('upvote');
        elseif ($voteValue === -1)
            $post->increment('downvote');

        $postVote->update(['vote' => $voteValue]);

        return response()->json([
            'success' => true,
            'upvotes' => $post->upvote,
            'downvotes' => $post->downvote,
            'user_vote' => $voteValue,
        ]);
    }

    public function like(Request $request, Post $post)
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }
        $user = auth()->user();
        $postVote = $post->votes()->firstOrCreate(
            ['user_id' => $user->id],
            ['liked' => false, 'vote' => 0]
        );

        $postVote->liked = !$postVote->liked;
        $postVote->save();

        if ($postVote->liked) {
            $post->increment('likes');
        } else {
            $post->decrement('likes');
        }

        return response()->json([
            'success' => true,
            'likes' => $post->likes,
            'liked' => $postVote->liked,
        ]);
    }
}
