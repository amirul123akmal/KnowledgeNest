<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatUsage;
use Carbon\Carbon;

class UserDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $stats = [
            'posts_count' => $user->posts()->count(),
            'saved_count' => $user->savedPosts()->count(),
            'upvotes_received' => $user->posts()->sum('upvote'),
            'comments_count' => $user->comments()->count(),
            'views' => $user->posts()->sum('views'),
            'chat_messages_today' => ChatUsage::where('user_id', $user->id)
                ->whereDate('created_at', Carbon::today())
                ->count(),
            'chat_total_messages' => ChatUsage::where('user_id', $user->id)->count(),
        ];

        $query = $user->posts();

        // Sorting Logic
        $sort = request('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->oldest();
                break;
            case 'popular':
                $query->orderByDesc('views');
                break;
            default: // newest
                $query->latest();
                break;
        }

        $recentPosts = $query->withCount('comments')
            ->paginate(6)
            ->withQueryString();

        $savedPosts = $user->savedPosts()
            ->latest()
            ->get();

        // Comments on the user's posts
        $recentComments = \App\Models\Comment::whereHas('post', function ($query) use ($user) {
            $query->where('author_id', $user->id);
        })
            ->latest()
            ->take(6)
            ->with(['author', 'post'])
            ->get();

        // Calculate top tags
        // Assuming tags are stored as comma-separated string in 'tags' column
        $allTags = $user->posts()
            ->select('tags')
            ->whereNotNull('tags')
            ->get()
            ->pluck('tags')
            ->map(function ($tags) {
                $tags = json_decode(json_decode($tags, true), true);
                $tags = array_column($tags, 'value');
                return $tags;
            })
            ->flatten();

        $topTags = $allTags->countBy()
            ->sortDesc()
            ->take(10)
            ->map(function ($count, $name) {
                return (object) ['name' => $name, 'count' => $count];
            })
            ->values(); // reset keys to 0,1,2...


        return view('user.dashboard', compact('user', 'stats', 'recentPosts', 'savedPosts', 'recentComments', 'topTags'));
    }
}
