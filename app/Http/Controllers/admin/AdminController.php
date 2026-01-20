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
        $posts = Post::latest()->take(5)->get();
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

        return view("admin.main", compact(
            "posts",
            "stats",
            "tags",
            "tagCountsValues",
            "usersLabels",
            "usersData",
            "totalPosts"
        ));
    }

    public function users(Request $request)
    {
        $query = User::query();

        // Search
        if ($request->has('q') && $request->q) {
            $q = $request->q;
            $query->where(function ($k) use ($q) {
                $k->where('name', 'like', '%' . $q . '%')
                    ->orWhere('email', 'like', '%' . $q . '%')
                    ->orWhere('phone', 'like', '%' . $q . '%'); // Optional: Search by phone too
            });
        }

        // Filters
        if ($request->has('role') && $request->role) {
            $query->where('role', $request->role);
        }
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        if ($sort === 'oldest') {
            $query->oldest();
        } elseif ($sort === 'name_asc') {
            $query->orderBy('name', 'asc');
        } else {
            $query->latest();
        }

        $users = $query->paginate(10);

        // Stats
        $totalUsers = User::count();
        $activeUsers = User::where('status', 'active')->count();
        // Replacement for Pending: New Users (last 30 days)
        $newUsers = User::where('created_at', '>=', now()->subDays(30))->count();

        // Roles for filter
        $roles = User::distinct()->pluck('role');

        return view("admin.users", compact("users", "totalUsers", "activeUsers", "newUsers", "roles"));
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
        $user = User::findOrFail($id);
        $roles = User::distinct()->pluck('role');
        return view('admin.edit_user', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'role' => 'required|string',
            'status' => 'required|in:active,suspended,pending',
            'verified' => 'boolean',
            'password' => 'nullable|string|min:8',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];
        $user->role = $validated['role'];
        $user->status = $validated['status'];
        $user->verified = $request->has('verified');

        if ($request->filled('password')) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
