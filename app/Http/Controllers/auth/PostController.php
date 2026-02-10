<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.newpost');
    }

    public function saved(Request $request)
    {
        $user = auth()->user();
        $query = $user->savedPosts()->with(['author', 'votes']);

        // Filter by Tag
        if ($request->has('tag') && $request->tag != '') {
            $query->whereJsonContains('tags', ['value' => $request->tag]);
        }

        // Sort
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'views':
                    $query->orderBy('views', 'desc');
                    break;
                case 'upvotes':
                    $query->orderBy('upvote', 'desc');
                    break;
                case 'latest':
                default:
                    // Pivot timestamp for when it was saved
                    $query->orderByPivot('created_at', 'desc');
                    break;
            }
        } else {
            $query->orderByPivot('created_at', 'desc');
        }

        $savedPosts = $query->paginate(12);

        // Get all unique tags from posts
        // Since tags are JSON, we might need a raw query or just fetch from recent posts to avoid heavy parsing
        // For now, let's just get tags from the user's saved posts to filter what they have
        $savedIds = $user->savedPosts()->pluck('posts.id');
        $tagsData = Post::whereIn('id', $savedIds)->pluck('tags');
        $allTags = collect();
        foreach ($tagsData as $t) {
            if ($t) {
                $decoded = json_decode($t, true);
                if (is_array($decoded)) {
                    foreach ($decoded as $tagItem) {
                        // Assuming tag structure is [{"value":"tagname", ...}] or just strings
                        $tagName = $tagItem['value'] ?? $tagItem;
                        $allTags->push((object) ['name' => $tagName]);
                    }
                }
            }
        }
        $allTags = $allTags->unique('name')->sortBy('name');

        // Recommended: posts not saved by user
        $recommended = Post::whereNotIn('id', $savedIds)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('user.saved', compact('savedPosts', 'allTags', 'recommended'));
    }

    public function voteAsync(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }
        $request->validate([
            'post_id' => 'required|exists:posts,id',
        ]);

        $post = Post::findOrFail($request->post_id);
        $user = auth()->user();

        // Logic for Heart Toggle (Like)
        $postVote = $post->votes()->firstOrCreate(
            ['user_id' => $user->id],
            ['liked' => false, 'vote' => 0]
        );

        $postVote->liked = !$postVote->liked;
        $postVote->save();

        if ($postVote->liked)
            $post->increment('likes');
        else
            $post->decrement('likes');

        return response()->json([
            'success' => true,
            'liked' => $postVote->liked,
            'message' => $postVote->liked ? 'Liked' : 'Unliked'
        ]);
    }
    public function toggleSaveAsync(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }
        $request->validate(['post_id' => 'required|exists:posts,id']);

        $user = auth()->user();
        $postId = $request->post_id;

        $toggled = $user->savedPosts()->toggle($postId);
        $isSaved = count($toggled['attached']) > 0;

        return response()->json([
            'success' => true,
            'is_saved' => $isSaved,
            'message' => $isSaved ? 'Saved' : 'Removed from saved'
        ]);
    }

    public function clearSaved()
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }
        $user = auth()->user();
        $user->savedPosts()->detach();

        return response()->json(['success' => true, 'message' => 'All saved posts cleared']);
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
            'thumbnail' => 'nullable|image|max:8192'
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

        // Update search index cache
        \Illuminate\Support\Facades\Cache::forget('posts_search_index');

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->tags = json_decode($post->tags, true);
        $post->increment('views');

        $userVote = null;
        if (auth()->check()) {
            $userVote = $post->votes()->where('user_id', auth()->id())->first();
        }

        $isSaved = false;
        if (auth()->check()) {
            $isSaved = auth()->user()->savedPosts()->where('post_id', $post->id)->exists();
        }

        return view('guest.post', compact('post', 'userVote', 'isSaved'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if ($post->tags) {
            $decoded = json_decode($post->tags);
            if (is_string($decoded)) {
                $post->tags = $decoded;
            }
        }
        return view('user.editpost', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'brief_description' => 'nullable|string',
            'markdown' => 'required|string',
            'tags' => 'nullable',
            'tags.*' => 'string',
            'difficulty' => 'required|integer|min:1|max:3',
            'thumbnail' => 'nullable|image|max:8192'
        ]);

        $thumbnailPath = $post->thumbnail;
        if ($request->hasFile('thumbnail')) {
            // Optional: Delete old thumbnail
            if ($post->thumbnail) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($post->thumbnail);
            }
            $thumbnailPath = \Illuminate\Support\Facades\Storage::disk('public')->put('thumbnails', $request->file('thumbnail'));
        }

        $post->update([
            'title' => $request->title,
            'brief_description' => $request->brief_description,
            'content' => $request->markdown,
            'tags' => $request->tags ? json_encode($request->tags) : null,
            'difficulty' => $request->difficulty,
            'thumbnail' => $thumbnailPath,
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'Post updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        if ($post->author_id !== auth()->id()) {
            return abort(403);
        }

        if ($post->thumbnail) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($post->thumbnail);
        }

        $post->delete();

        return redirect()->route('dashboard.index')->with('success', 'Post deleted successfully.');
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

    public function save(Request $request, Post $post)
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }
        $user = auth()->user();

        $toggled = $user->savedPosts()->toggle($post->id);
        $isSaved = count($toggled['attached']) > 0;

        return response()->json([
            'success' => true,
            'is_saved' => $isSaved,
        ]);
    }

    public function storeComment(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        if (!auth()->check()) {
            return redirect()->route('login.index');
        }

        Comment::create([
            'comment' => $request->comment,
            'post_id' => $post->id,
            'author_id' => auth()->id(),
            'upvote' => 0,
            'downvote' => 0,
        ]);

        $post->increment('comments');

        return back();
    }

    public function replyComment(Request $request, Comment $comment)
    {
        $request->validate([
            'reply' => 'required|string|max:1000',
        ]);

        if (!auth()->check()) {
            return redirect()->route('login.index');
        }

        Comment::create([
            'comment' => $request->reply,
            'post_id' => $comment->post_id,
            'author_id' => auth()->id(),
            'parent_comment_id' => $comment->id,
            'upvote' => 0,
            'downvote' => 0,
        ]);

        // Optional: Increment post comment count if desired
        $comment->post->increment('comments');

        return back();
    }

    public function voteComment(Request $request, Comment $comment)
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }
        $request->validate([
            'vote' => 'required|in:1,-1,0',
        ]);

        $user = auth()->user();
        $voteValue = (int) $request->vote;

        $commentVote = $comment->votes()->firstOrCreate(
            ['user_id' => $user->id],
            ['liked' => false, 'vote' => 0]
        );

        // If clicking the same vote again, toggle it off (set to 0)
        if ($commentVote->vote === $voteValue) {
            $voteValue = 0;
        }

        // Update counts on Comment model
        // First revert old vote
        if ($commentVote->vote === 1)
            $comment->decrement('upvote');
        elseif ($commentVote->vote === -1)
            $comment->decrement('downvote');

        // Apply new vote
        if ($voteValue === 1)
            $comment->increment('upvote');
        elseif ($voteValue === -1)
            $comment->increment('downvote');

        $commentVote->update(['vote' => $voteValue]);

        return response()->json([
            'success' => true,
            'upvotes' => $comment->upvote,
            'downvotes' => $comment->downvote,
            'user_vote' => $voteValue,
        ]);
    }
}
