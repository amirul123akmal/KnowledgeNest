<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Post::query();

        // Search
        if ($request->has('q') && $request->q) {
            $q = $request->q;
            $query->where(function ($k) use ($q) {
                $k->where('title', 'like', '%' . $q . '%')
                    ->orWhere('tags', 'like', '%' . $q . '%'); // Simple tag search
            });
        }

        // Filters
        if ($request->has('tag') && $request->tag) {
            // JSON Search (simple string match for now as tags are JSON string)
            $query->where('tags', 'like', '%' . $request->tag . '%');
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('days') && $request->days) {
            $days = (int) $request->days;
            $query->where('created_at', '>=', now()->subDays($days));
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        if ($sort === 'oldest') {
            $query->oldest();
        } elseif ($sort === 'most-viewed') {
            $query->orderByDesc('views');
        } else {
            $query->latest();
        }

        $posts = $query->paginate(10);

        // Tags for filter dropdown
        $allTags = [];
        $allTagsJson = Post::pluck('tags');
        foreach ($allTagsJson as $tagsEntry) {
            $tagsData = is_string($tagsEntry) ? json_decode($tagsEntry, true) : $tagsEntry;
            if (is_string($tagsData))
                $tagsData = json_decode($tagsData, true); // Double decode check

            if (!empty($tagsData) && is_array($tagsData)) {
                foreach ($tagsData as $tag) {
                    if (is_array($tag) && isset($tag['value'])) {
                        $allTags[] = trim($tag['value']);
                    } elseif (is_string($tag)) {
                        $allTags[] = trim($tag);
                    }
                }
            }
        }
        $tagCounts = array_count_values($allTags);
        arsort($tagCounts);
        $tags = array_slice(array_keys($tagCounts), 0, 20); // Top 20 tags

        return view('admin.posts', compact('posts', 'tags'));
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
        //
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
        $post = Post::findOrFail($id);

        // Align with User Controller tag handling
        if ($post->tags) {
            $decoded = json_decode($post->tags);
            if (is_string($decoded)) {
                $post->tags = $decoded;
            }
        }

        return view('admin.edit_post', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'brief_description' => 'nullable|string',
            'markdown' => 'required|string',
            'tags' => 'nullable',
            'tags.*' => 'string',
            'difficulty' => 'required|integer|min:1|max:3',
            'thumbnail' => 'nullable|image|max:8192',
            'status' => 'required|in:published,pending,draft,archived'
        ]);

        $thumbnailPath = $post->thumbnail;
        if ($request->hasFile('thumbnail')) {
            if ($post->thumbnail) {
                Storage::delete($post->thumbnail);
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
            'status' => $request->status,
        ]);

        \Illuminate\Support\Facades\Cache::rememberForever('posts_search_index', function () {
            return Post::with(['author', 'comments'])->get();
        });

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        if ($post->thumbnail) {
            Storage::delete($post->thumbnail);
        }
        $post->delete();

        return redirect()->back()->with('success', 'Post deleted successfully.');
    }
}
