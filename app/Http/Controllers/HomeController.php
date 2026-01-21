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
    public function index()
    {
        $posts = Post::with([
            'author',
            'votes' => function ($query) {
                $query->where('user_id', auth()->id());
            }
        ])->latest()->get();
        // dd($posts, $posts[1]->author);
        return view("welcome", compact("posts"));
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
            return Post::with(['author', 'comments', 'votes'])->get();
        });
    }
}
