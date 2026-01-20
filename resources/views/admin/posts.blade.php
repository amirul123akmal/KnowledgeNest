@extends('layout.admin')

@section('content')
    <main class="p-6 md:p-8 flex-1 overflow-y-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Posts</h1>
                <p class="text-slate-500">Manage, approve, and moderate user content.</p>
            </div>
            <div class="flex items-center gap-3">
                <!-- Export or Add New could go here -->
            </div>
        </div>

        <!-- Filter Card -->
        <div class="card p-6 mb-8 bg-white border border-slate-100 shadow-sm rounded-3xl">
            <form method="GET" action="{{ route('admin.posts.index') }}" class="grid grid-cols-1 md:grid-cols-12 gap-4">
                <div class="md:col-span-7">
                    <div class="relative">
                        <input name="q" value="{{ request('q') }}" type="search" placeholder="Search by title or content..." class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 pl-10 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/50" />
                        <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="md:col-span-2">
                    <select name="tag" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/50 text-slate-600">
                        <option value="">All Tags</option>
                        @foreach($tags as $tag)
                            <option value="{{ $tag }}" @selected(request('tag') == $tag)>{{ $tag }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-span-2">
                    <select name="sort" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/50 text-slate-600">
                        <option value="newest" @selected(request('sort') == 'newest')>Newest First</option>
                        <option value="oldest" @selected(request('sort') == 'oldest')>Oldest First</option>
                        <option value="most-viewed" @selected(request('sort') == 'most-viewed')>Most Viewed</option>
                    </select>
                </div>
                <div class="md:col-span-1">
                    <button type="submit" class="w-full bg-brand-600 hover:bg-brand-700 text-white p-2.5 rounded-xl transition-colors shadow-sm font-semibold text-sm">
                        Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Posts Table -->
        <section class="card p-0 overflow-hidden bg-white border border-slate-100 shadow-sm rounded-3xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 font-semibold text-slate-600 uppercase tracking-wider text-xs">Post</th>
                            <th class="px-6 py-4 font-semibold text-slate-600 uppercase tracking-wider text-xs">Author</th>
                            <th class="px-6 py-4 font-semibold text-slate-600 uppercase tracking-wider text-xs">Tags</th>
                            <th class="px-6 py-4 font-semibold text-slate-600 uppercase tracking-wider text-xs text-center">Stats</th>
                            <th class="px-6 py-4 font-semibold text-slate-600 uppercase tracking-wider text-xs text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($posts as $post)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="h-12 w-12 rounded-xl overflow-hidden shrink-0 shadow-sm border border-slate-100">
                                            <img src="{{ $post->thumbnail ? Storage::url($post->thumbnail) : asset('images/post.jpg') }}" alt="" class="h-full w-full object-cover" />
                                        </div>
                                        <div class="min-w-0 max-w-xs">
                                            <div class="font-bold text-slate-900 truncate">{{ $post->title }}</div>
                                            <div class="text-xs text-slate-500 truncate mt-0.5">{{ Str::limit($post->excerpt ?? '', 50) }}</div>
                                            <div class="text-xs text-slate-400 mt-1">{{ $post->created_at->format('M d, Y') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="h-6 w-6 rounded-full bg-brand-100 flex items-center justify-center text-xs font-bold text-brand-600">
                                            {{ substr($post->author->name ?? 'U', 0, 1) }}
                                        </div>
                                        <span class="text-slate-600 font-medium">{{ $post->author->name ?? 'Unknown' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1">
                                        @php
                                            $postDataTags = is_string($post->tags) ? json_decode($post->tags, true) : $post->tags;
                                            if (is_string($postDataTags)) {
                                                $postDataTags = json_decode($postDataTags, true);
                                            }
                                        @endphp
                                        @foreach(($postDataTags ?? []) as $tag)
                                            <span class="inline-flex items-center px-2 py-1 rounded-md bg-white border border-slate-200 text-xs font-semibold text-slate-600">
                                                {{ is_array($tag) ? ($tag['value'] ?? '') : $tag }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="inline-flex items-center gap-3 px-3 py-1 bg-slate-50 rounded-lg border border-slate-100">
                                        <div class="flex items-center gap-1 text-slate-600" title="Views">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            <span class="font-bold text-xs">{{ $post->views ?? 0 }}</span>
                                        </div>
                                        <div class="w-px h-3 bg-slate-300"></div>
                                        <div class="flex items-center gap-1 text-emerald-600" title="Upvotes">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                            </svg>
                                            <span class="font-bold text-xs">{{ $post->upvote ?? 0 }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        @if($post->status === 'pending')
                                            {{-- Assuming we have an action for approve, placeholder for now --}}
                                            <form method="POST" action="">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="published">
                                                <button type="submit" class="p-2 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition-colors" title="Approve">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="p-2 rounded-lg bg-slate-50 text-slate-500 hover:bg-slate-100 hover:text-brand-600 transition-colors" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>

                                        <form method="POST" action="{{ route('admin.posts.destroy', $post->id) }}" onsubmit="return confirm('Delete this post?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-lg bg-red-50 text-red-500 hover:bg-red-100 transition-colors" title="Delete">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-slate-400">
                                        <svg class="w-12 h-12 mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <p class="text-sm font-medium">No posts matches your filters</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($posts, 'links'))
                <div class="p-4 border-t border-slate-50">
                    {{ $posts->withQueryString()->links() }}
                </div>
            @endif
        </section>
    </main>
@endsection