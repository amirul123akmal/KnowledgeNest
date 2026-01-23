<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Loilo\Fuse\Fuse;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Post::with([
            'author'
        ]);
        // Handle tag filtering
        $selectedTags = $request->input('tags') ? explode(',', $request->input('tags')) : [];

        if (!empty($selectedTags)) {
            // AND logic: posts must have ALL selected tags
            foreach ($selectedTags as $tag) {
                // Tags in DB: "[{\"value\":\"Help\"},{\"value\":\"DIY\"}]"
                // The backslashes are stored as literal \\ in the database
                // So we need to search for: %{\\\"value\\\":\\\"TagName\\\"}%
                $searchPattern = '%{\\\\\"value\\\\\":\\\\\"' . $tag . '\\\\\"}%';
                $query->where('tags', 'LIKE', $searchPattern);
            }
        }

        // Paginate results
        $posts = $query->latest()->paginate(12)->appends(['tags' => $request->input('tags')]);
        // Get trending tags and all tags
        $trendingTags = $this->getTrendingTags();
        $allTags = $this->getAllTags();

        return view("welcome", compact("posts", "trendingTags", "allTags", "selectedTags"));
    }

    /**
     * Get trending tags based on posts from the last 30 days
     */
    private function getTrendingTags()
    {
        // Get posts from the last 30 days
        $recentPosts = Post::where('created_at', '>=', now()->subDays(60))
            ->whereNotNull('tags')
            ->get();

        // dd(json_decode(json_decode($recentPosts[0]->tags, true), true), $recentPosts[0]->tags);

        // Count tag occurrences
        $tagCounts = [];
        foreach ($recentPosts as $post) {
            // Tags are stored as comma-separated string
            $tags = json_decode(json_decode($post->tags, true), true);
            foreach ($tags as $tag) {
                $data = $tag["value"];
                if (!empty($data)) {
                    if (!isset($tagCounts[$data])) {
                        $tagCounts[$data] = 0;
                    }
                    $tagCounts[$data]++;
                }
            }
        }

        $emojis = [
            '🔥',
            '⚡',
            '🪐',
        ];

        // Sort by count descending and get top 5
        arsort($tagCounts);
        $topTags = array_slice($tagCounts, 0, 3, true);

        // Format for view - using fixed icon since tags are user-generated
        $trendingTags = [];
        $index = 0;
        foreach ($topTags as $tag => $count) {
            $trendingTags[] = [
                'name' => $tag,
                'icon' => $emojis[$index++],
                'count' => $count
            ];
        }

        return $trendingTags;
    }

    /**
     * Get all unique tags from all posts
     */
    private function getAllTags()
    {
        $allPosts = Post::whereNotNull('tags')->get();
        $uniqueTags = [];

        foreach ($allPosts as $post) {
            $tags = json_decode(json_decode($post->tags, true), true);
            if (is_array($tags)) {
                foreach ($tags as $tag) {
                    if (isset($tag['value']) && !empty($tag['value'])) {
                        $uniqueTags[$tag['value']] = true;
                    }
                }
            }
        }

        $tags = array_keys($uniqueTags);
        sort($tags);
        return $tags;
    }

    /**
     * Get consistent color for a tag based on its name
     */
    public static function getTagColor($tagName)
    {
        $colors = [
            ['bg' => 'bg-blue-50', 'text' => 'text-blue-600'],
            ['bg' => 'bg-purple-50', 'text' => 'text-purple-600'],
            ['bg' => 'bg-pink-50', 'text' => 'text-pink-600'],
            ['bg' => 'bg-orange-50', 'text' => 'text-orange-600'],
            ['bg' => 'bg-green-50', 'text' => 'text-green-600'],
            ['bg' => 'bg-teal-50', 'text' => 'text-teal-600'],
            ['bg' => 'bg-indigo-50', 'text' => 'text-indigo-600'],
            ['bg' => 'bg-rose-50', 'text' => 'text-rose-600'],
            ['bg' => 'bg-cyan-50', 'text' => 'text-cyan-600'],
            ['bg' => 'bg-amber-50', 'text' => 'text-amber-600'],
        ];

        $index = abs(crc32($tagName)) % 10;
        return $colors[$index];
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

    public function search(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return redirect()->route('posts.index');
        }

        $posts = $this->getSearchIndex();

        // Fuse expects an array, not a Collection.
        // We use ->all() to get the underlying array of Models.
        $threshold = \Illuminate\Support\Facades\Cache::get('search_threshold', 0.75);
        $keys = \Illuminate\Support\Facades\Cache::get('search_keys', ['title', 'content', 'brief_description', 'tags', 'comments.content']);

        $fuse = new \Fuse\Fuse($posts->all(), [
            'keys' => $keys,
            'threshold' => $threshold,
        ]);

        $results = $fuse->search($query);
        $posts = collect($results)->pluck('item');

        return view('search.results', compact('posts', 'query'));
    }

    private function getSearchIndex()
    {
        return \Illuminate\Support\Facades\Cache::rememberForever('posts_search_index', function () {
            return Post::with(['author', 'comments'])->get();
        });
    }
}
