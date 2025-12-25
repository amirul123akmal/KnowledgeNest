@extends('layout.guest')

@section('content')
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-12min-h-screen">

        {{-- Top Section: Hero & Stats --}}
        <div class="grid grid-cols-12 gap-8 items-start mb-12">
            {{-- HERO SECTION --}}
            <section class="col-span-12 lg:col-span-8 relative z-10">
                <div class="relative bg-linear-to-br from-brand-900 to-indigo-900 rounded-[2.5rem] p-8 md:p-12 overflow-hidden shadow-2xl border border-white/10 group">
                    {{-- Animated Background Effects --}}
                    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-brand-500/30 rounded-full blur-[100px] animate-pulse"></div>
                    <div class="absolute bottom-0 left-0 -ml-24 -mb-24 w-80 h-80 bg-purple-500/20 rounded-full blur-[80px]"></div>

                    <div class="relative flex flex-col md:flex-row items-center md:items-start gap-8">
                        {{-- Avatar with Status Ring --}}
                        <div class="shrink-0 relative">
                            <div class="absolute -inset-1 bg-linear-to-r from-brand-400 to-purple-500 rounded-[1.3rem] blur opacity-75 group-hover:opacity-100 transition duration-1000"></div>
                            <img src="{{ auth()->user()->picture ? Storage::url(auth()->user()->picture) : asset('images/profile.jpg') }}" alt="avatar" class="relative w-28 h-28 rounded-2xl object-cover border-4 border-brand-900 shadow-2xl">
                        </div>

                        <div class="flex-1 text-center md:text-left">
                            <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight leading-tight">
                                Your <span class="text-transparent bg-clip-text bg-linear-to-r from-brand-200 to-purple-200">Library</span>
                            </h1>
                            <p class="mt-3 text-brand-100/80 text-lg font-medium max-w-lg mx-auto md:mx-0">
                                Curated collection of posts you've bookmarked for later reading.
                            </p>

                            {{-- Stats Row --}}
                            <div class="mt-8 flex flex-wrap justify-center md:justify-start gap-4">
                                <div class="flex items-center gap-3 bg-white/10 backdrop-blur-md border border-white/10 rounded-2xl px-5 py-3">
                                    <div class="bg-brand-500/20 rounded-lg text-brand-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                        </svg>
                                    </div>
                                    <div class="flex items-center gap-2 text-left">
                                        <div class="text-white font-bold text-xl leading-none">{{ $savedPosts->total() ?? $savedPosts->count() }}</div>
                                        <div class="text-brand-200/70 text-xs uppercase tracking-wider font-semibold">Saved</div>
                                    </div>
                                </div>

                                <a href="/" class="group flex items-center gap-2 px-6 py-3 rounded-2xl font-bold text-white border border-white/20 hover:bg-white/10 transition-all">
                                    Browse Feed
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- SIDEBAR: CONTROL CENTER --}}
            <aside class="col-span-12 lg:col-span-4 space-y-6">
                {{-- Filters Card --}}
                <div class="bg-white rounded-4xl p-6 border border-slate-100 shadow-xl shadow-slate-200/50">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-slate-800 font-extrabold text-lg flex items-center gap-2">
                            <svg class="w-5 h-5 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                            Filter & Sort
                        </h3>
                    </div>

                    <form action="{{ route('posts.saved') }}" method="GET" class="space-y-5">
                        {{-- Custom Select: Tag --}}
                        <div class="relative group">
                            <label class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1.5 block">Topic</label>
                            <div class="relative">
                                <select name="tag" class="w-full appearance-none bg-slate-50 border border-slate-200 text-slate-700 font-semibold py-3 px-4 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition cursor-pointer">
                                    <option value="">All Topics</option>
                                    @foreach($allTags as $tag)
                                        <option value="{{ $tag->name }}" @selected(request('tag') == $tag->name)>{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-500">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        {{-- Custom Select: Sort --}}
                        <div class="relative">
                            <label class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1.5 block">Sort By</label>
                            <div class="relative">
                                <select name="sort" class="w-full appearance-none bg-slate-50 border border-slate-200 text-slate-700 font-semibold py-3 px-4 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition cursor-pointer">
                                    <option value="latest" @selected(request('sort') == 'latest')>Recently Saved</option>
                                    <option value="views" @selected(request('sort') == 'views')>Most Popular</option>
                                    <option value="upvotes" @selected(request('sort') == 'upvotes')>Highest Rated</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-500">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="pt-2 flex gap-3">
                            <button type="submit" class="flex-1 bg-brand-600 text-white px-4 py-3 rounded-xl font-bold hover:bg-brand-700 hover:shadow-lg hover:shadow-brand-500/30 transition transform active:scale-95">
                                Apply
                            </button>
                            @if(request()->hasAny(['tag', 'sort']))
                                <a href="{{ route('posts.saved') }}" class="px-4 py-3 rounded-xl font-bold text-slate-500 hover:bg-slate-100 hover:text-slate-700 transition" title="Reset Filters">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </form>
                </div>

                @if($savedPosts->count() > 0)
                    <button id="clearSaved" type="button" class="w-full group flex items-center justify-center gap-2 text-sm font-semibold text-red-500 bg-red-50 border border-red-100 hover:bg-red-100 hover:border-red-200 rounded-xl px-4 py-3 transition">
                        <svg class="w-4 h-4 opacity-70 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Clear All Items
                    </button>
                @endif
            </aside>
        </div>

        {{-- CONTENT GRID --}}
        <div class="grid grid-cols-12 gap-8">
            <section class="col-span-12 lg:col-span-8">
                @if($savedPosts->count())
                    {{-- Staggered Animation Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="posts-grid">
                        @foreach($savedPosts as $index => $post)
                            @php
                                $userLiked = optional($post->votes->first())->liked;
                            @endphp

                            {{-- Enhanced Card --}}
                            <article class="post-card group relative bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)] transition-all duration-300 hover:-translate-y-1 opacity-0 translate-y-4" style="animation-delay: {{ $index * 50 }}ms">

                                {{-- Image Section --}}
                                <div class="relative h-52 rounded-t-3xl overflow-hidden">
                                    <img src="{{ $post->thumbnail ? Storage::url($post->thumbnail) : asset('images/post.jpg') }}" alt="{{ $post->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">

                                    {{-- Overlay Gradient --}}
                                    <div class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-60"></div>

                                    {{-- Category Badge (On Image) --}}
                                    <div class="absolute top-4 left-4">
                                        <span class="bg-white/90 backdrop-blur-sm text-slate-800 text-[10px] font-extrabold px-2.5 py-1 rounded-lg uppercase tracking-wider shadow-sm">
                                            {{ $post->category->name ?? 'Article' }}
                                        </span>
                                    </div>

                                    {{-- Unsave Button (Top Right) --}}
                                    <button class="btn-unsave absolute top-4 right-4 p-2 rounded-full bg-slate-900/50 backdrop-blur-md text-white border border-white/20 hover:bg-red-500 hover:border-red-500 hover:text-white transition-colors duration-300 shadow-lg" data-post-id="{{ $post->id }}" title="Remove from saved">
                                        {{-- Icon swaps on hover via CSS group (or simplified here) --}}
                                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                            <path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                        </svg>
                                    </button>
                                </div>

                                {{-- Content Section --}}
                                <div class="p-5">
                                    <div class="flex items-center gap-2 mb-3 text-xs font-medium text-slate-400">
                                        <span>{{ $post->created_at->format('M d, Y') }}</span>
                                        <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                                        <span>{{ ceil(str_word_count($post->body ?? '') / 200) }} min read</span>
                                    </div>

                                    <h3 class="font-bold text-slate-800 text-xl leading-tight mb-2 group-hover:text-brand-600 transition-colors line-clamp-2">
                                        <a href="{{ route('posts.show', $post) }}">
                                            <span class="absolute inset-0 z-0"></span>
                                            {{ $post->title }}
                                        </a>
                                    </h3>

                                    <p class="text-slate-500 text-sm line-clamp-2 leading-relaxed mb-5">
                                        {{ $post->brief_description }}
                                    </p>

                                    {{-- Footer --}}
                                    <div class="flex items-center justify-between border-t border-slate-50 pt-4 relative z-10">
                                        <div class="flex items-center gap-2.5">
                                            <img src="{{ $post->author->picture ? Storage::url($post->author->picture) : asset('images/profile.jpg') }}" class="w-6 h-6 rounded-full object-cover ring-2 ring-slate-50" alt="Avatar">
                                            <span class="text-xs font-bold text-slate-600">{{ $post->author->name }}</span>
                                        </div>

                                        <button class="like-btn flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold transition-all {{ $userLiked ? 'bg-red-50 text-red-500' : 'bg-slate-50 text-slate-500 hover:bg-slate-100' }}" data-post-id="{{ $post->id }}">
                                            <svg class="w-4 h-4 {{ $userLiked ? 'fill-current' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                            <span>{{ $post->votes_count ?? 0 }}</span>
                                        </button>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div class="mt-10">
                        {{ $savedPosts->withQueryString()->links() }}
                    </div>
                @else
                    {{-- Empty State --}}
                    <div class="flex flex-col items-center justify-center text-center bg-white rounded-4xl p-12 border border-slate-100 border-dashed shadow-sm">
                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-6 text-slate-300">
                            <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-2">No saved stories yet</h3>
                        <p class="text-slate-500 max-w-sm mx-auto mb-8">When you find something interesting, bookmark it to read it later here.</p>
                        <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-2 bg-brand-600 text-white px-8 py-3 rounded-full font-bold hover:bg-brand-700 transition shadow-lg shadow-brand-500/30">
                            Explore Content
                        </a>
                    </div>
                @endif
            </section>

            {{-- Right Sidebar: Recommended --}}
            <aside class="col-span-12 lg:col-span-4 space-y-6">
                @if($recommended->count())
                    <div class="bg-white rounded-4xl p-6 border border-slate-100 shadow-card">
                        <h4 class="text-slate-800 font-extrabold text-lg mb-1">Recommended for you</h4>
                        <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider mb-5">Based on your history</p>

                        <div class="space-y-4">
                            @foreach($recommended as $r)
                                <a href="{{ route('posts.show', $r) }}" class="flex gap-4 group hover:bg-slate-50 p-2 -mx-2 rounded-xl transition">
                                    <img src="{{ $r->thumbnail ? Storage::url($r->thumbnail) : asset('images/post.jpg') }}" class="w-20 h-20 rounded-xl object-cover shadow-sm group-hover:scale-105 transition-transform" alt="">
                                    <div class="flex-1 py-1">
                                        <h5 class="text-sm font-bold text-slate-800 leading-snug group-hover:text-brand-600 transition-colors line-clamp-2">{{ $r->title }}</h5>
                                        <div class="mt-2 flex items-center gap-2 text-[10px] text-slate-400 font-semibold uppercase">
                                            <span>{{ $r->author->name }}</span>
                                            <span>•</span>
                                            <span>{{ $r->created_at->diffForHumans(null, true, true) }}</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <div class="mt-6 pt-4 border-t border-slate-50 text-center">
                            <a href="{{ route('posts.index') }}" class="text-brand-600 text-sm font-bold hover:text-brand-700 hover:underline">View all posts &rarr;</a>
                        </div>
                    </div>
                @endif

                {{-- Promo/Ad Placeholder --}}
                <div class="bg-linear-to-br from-indigo-600 to-purple-700 rounded-4xl p-8 text-center text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mr-10 -mt-10 w-32 h-32 bg-white/20 rounded-full blur-2xl"></div>
                    <h5 class="font-bold text-xl relative z-10">Weekly Newsletter</h5>
                    <p class="text-indigo-100 text-sm mt-2 mb-4 relative z-10">Get the top stories delivered to your inbox.</p>
                    <button class="w-full py-2 bg-white text-indigo-700 font-bold rounded-xl shadow-lg hover:bg-indigo-50 transition relative z-10">Subscribe</button>
                </div>
            </aside>
        </div>
    </main>

    @push('scripts')
        <script>
            // Animation for grid items
            document.addEventListener("DOMContentLoaded", () => {
                const cards = document.querySelectorAll('.post-card');
                cards.forEach(card => {
                    // Simple JS equivalent to a fade-in-up animation
                    setTimeout(() => {
                        card.classList.remove('opacity-0', 'translate-y-4');
                    }, 50); // Small delay to allow CSS transition to catch
                });
            });

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

            // Like / unlike Logic
            document.querySelectorAll('.like-btn').forEach(btn => {
                btn.addEventListener('click', async (e) => {
                    e.preventDefault();
                    e.stopPropagation();

                    const postId = btn.getAttribute('data-post-id');
                    if (!postId) return;

                    btn.disabled = true;
                    // Visual feedback immediately
                    btn.style.opacity = '0.7';

                    try {
                        const res = await fetch("{{ route('posts.voteAsync') }}", {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                            body: JSON.stringify({ post_id: postId })
                        });

                        const data = await res.json();
                        if (!res.ok) throw new Error(data.message || 'Unable to vote');

                        // Toggle visual state classes
                        const span = btn.querySelector('span');
                        if (data.liked) {
                            btn.classList.remove('bg-slate-50', 'text-slate-500', 'hover:bg-slate-100');
                            btn.classList.add('bg-red-50', 'text-red-500');
                            btn.querySelector('svg')?.classList.add('fill-current');
                            if (span) span.innerText = parseInt(span.innerText) + 1;
                        } else {
                            btn.classList.add('bg-slate-50', 'text-slate-500', 'hover:bg-slate-100');
                            btn.classList.remove('bg-red-50', 'text-red-500');
                            btn.querySelector('svg')?.classList.remove('fill-current');
                            if (span) span.innerText = Math.max(0, parseInt(span.innerText) - 1);
                        }

                    } catch (err) {
                        console.error(err);
                        alert('Error voting');
                    } finally {
                        btn.disabled = false;
                        btn.style.opacity = '1';
                    }
                });
            });

            // Unsave button logic (Remains similar but targets the new card structure)
            document.querySelectorAll('.btn-unsave').forEach(btn => {
                btn.addEventListener('click', async (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    const postId = btn.getAttribute('data-post-id');

                    // Simple confirm if Swal is missing
                    if (window.Swal) {
                        const result = await Swal.fire({
                            title: 'Unsave post?',
                            text: "It will be removed from this list.",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#EF4444',
                            confirmButtonText: 'Yes, remove it'
                        });
                        if (!result.isConfirmed) return;
                    } else {
                        if (!confirm('Remove saved post?')) return;
                    }

                    btn.disabled = true;
                    try {
                        const res = await fetch("{{ route('posts.toggleSaveAsync') }}", {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                            body: JSON.stringify({ post_id: postId })
                        });
                        const data = await res.json();
                        if (!res.ok) throw new Error(data.message);

                        // Animated removal
                        const card = btn.closest('article');
                        if (card) {
                            card.style.transform = 'scale(0.9) translateY(10px)';
                            card.style.opacity = '0';
                            setTimeout(() => card.remove(), 300);
                        }
                    } catch (err) {
                        alert('Error: ' + err.message);
                    } finally {
                        btn.disabled = false;
                    }
                });
            });

            // Clear All Logic
            document.getElementById('clearSaved')?.addEventListener('click', async () => {
                if (window.Swal) {
                    const result = await Swal.fire({
                        title: 'Are you sure?',
                        text: "This will empty your saved list permanently.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#EF4444',
                        confirmButtonText: 'Yes, clear all'
                    });
                    if (!result.isConfirmed) return;
                } else {
                    if (!confirm('Clear all saved items?')) return;
                }

                try {
                    await fetch("{{ route('posts.clearSaved') }}", {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                        body: JSON.stringify({})
                    });
                    location.reload();
                } catch (e) { console.error(e); }
            });
        </script>
    @endpush
@endsection