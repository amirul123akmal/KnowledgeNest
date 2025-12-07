<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        // Calculate stats
        $totalPosts = Post::count();
        $postsLast30Days = Post::where('created_at', '>=', now()->subDays(30))->count();
        $postsPrevious30Days = Post::where('created_at', '>=', now()->subDays(60))->where('created_at', '<', now()->subDays(30))->count();
        $postsChangePercent = $postsPrevious30Days > 0 ? (($postsLast30Days - $postsPrevious30Days) / $postsPrevious30Days) * 100 : 100;

        $stats = [
            'totalPosts' => $totalPosts,
            'postsChangePercent' => round($postsChangePercent, 1)
        ];

        // Process Tags for Chart (Global, not just paginated)
        $allTags = [];
        // Fetch all tags directly from DB to allow chart to reflect all data
        $allTagsJson = Post::pluck('tags');

        foreach ($allTagsJson as $tagsEntry) {

            $tagsData = is_string($tagsEntry) ? json_decode($tagsEntry, true) : $tagsEntry;
            $tagsData = json_decode($tagsData, true);

            if (!empty($tagsData) && is_array($tagsData)) {
                foreach ($tagsData as $tag) {
                    if (is_array($tag) && isset($tag['value']) && !empty($tag['value'])) {
                        $allTags[] = trim($tag['value']);
                    } elseif (is_string($tag) && !empty($tag)) {
                        $allTags[] = trim($tag);
                    }
                }
            }
        }


        $tagCounts = array_count_values($allTags);
        arsort($tagCounts);
        $tags = array_keys($tagCounts);
        $tagCountsValues = array_values($tagCounts);

        // Take top 10
        $tags = array_slice($tags, 0, 10);
        $tagCountsValues = array_slice($tagCountsValues, 0, 10);

        // User stats (last 30 days)
        $usersLabels = [];
        $usersData = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $usersLabels[] = $date->format('M d');
            // Optimally we would group by date in DB, but for now this loop is fine for small scale
            $usersData[] = User::whereDate('created_at', $date)->count();
        }

        $filteredCount = $posts->count();

        return view("admin.main", compact(
            "posts",
            "stats",
            "tags",
            "tagCountsValues",
            "usersLabels",
            "usersData",
            "filteredCount",
            "totalPosts"
        ));
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
}
