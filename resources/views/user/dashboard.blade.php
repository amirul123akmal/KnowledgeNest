@extends('layout.guest')

@section('content')
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-12">

        {{-- HERO SECTION --}}
        <div class="relative w-full mb-10">
            {{-- Main Hero Card --}}
            <div class="relative overflow-hidden rounded-[2.5rem] bg-slate-900 border border-slate-800 shadow-2xl shadow-indigo-500/10">

                {{-- Background Effects --}}
                <div class="absolute top-0 right-0 -mt-20 -mr-20 w-96 h-96 bg-indigo-500/30 rounded-full blur-3xl opacity-50 animate-pulse"></div>
                <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-violet-600/20 rounded-full blur-3xl opacity-50"></div>

                {{-- Grid Pattern Overlay --}}
                <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 brightness-100 contrast-150"></div>

                <div class="relative z-10 p-8 md:p-12">
                    <div class="flex flex-col md:flex-row items-start gap-8">

                        {{-- Avatar with Status Ring --}}
                        <div class="relative group shrink-0">
                            <div class="absolute -inset-1 bg-linear-to-r from-indigo-500 to-violet-500 rounded-3xl blur opacity-40 group-hover:opacity-75 transition duration-500"></div>
                            <img src="{{ strpos($user->picture, 'https://') === 0 ? $user->picture : Storage::url($user->picture) }}" alt="avatar" class="relative w-32 h-32 rounded-2xl object-cover border-4 border-slate-900 shadow-2xl">
                            <div class="absolute bottom-2 right-2 w-5 h-5 bg-emerald-500 border-4 border-slate-900 rounded-full"></div>
                        </div>

                        {{-- Welcome Text & Actions --}}
                        <div class="flex-1 w-full">
                            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                                <div>
                                    <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight">
                                        Hello, <span class="text-transparent bg-clip-text bg-linear-to-r from-indigo-400 to-violet-400">{{ $user->name ?? 'User' }}</span>
                                        <span class="inline-block animate-wave origin-bottom-right">👋</span>
                                    </h1>
                                    <p class="mt-2 text-slate-400 text-lg font-medium">Here's what's happening with your content today.</p>
                                </div>
                                <div class="flex gap-3">
                                    <a href="{{ route('profile.index') }}" class="px-5 py-2.5 rounded-xl font-semibold text-slate-300 border border-white/10 hover:bg-white/5 transition hover:text-white text-sm">
                                        Edit Profile
                                    </a>
                                    <a href="{{ route('posts.create') }}" class="px-5 py-2.5 rounded-xl font-bold bg-white text-slate-900 hover:bg-indigo-50 transition shadow-[0_0_20px_rgba(255,255,255,0.3)] text-sm flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                        </svg>
                                        New Post
                                    </a>
                                </div>
                            </div>

                            {{-- Modern Bento Grid Stats --}}
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                {{-- Stat Item 1 --}}
                                <div class="bg-white/5 backdrop-blur-md rounded-2xl p-4 border border-white/5 hover:bg-white/10 transition group">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="p-2 rounded-lg bg-indigo-500/20 text-indigo-300 group-hover:text-indigo-200 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                            </svg>
                                        </div>
                                        <span class="text-slate-400 text-xs font-bold uppercase tracking-wider">Posts</span>
                                    </div>
                                    <div class="text-2xl font-black text-white">{{ $stats['posts_count'] ?? 0 }}</div>
                                </div>

                                {{-- Stat Item 2 --}}
                                <div class="bg-white/5 backdrop-blur-md rounded-2xl p-4 border border-white/5 hover:bg-white/10 transition group">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="p-2 rounded-lg bg-pink-500/20 text-pink-300 group-hover:text-pink-200 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                        </div>
                                        <span class="text-slate-400 text-xs font-bold uppercase tracking-wider">Received</span>
                                    </div>
                                    <div class="text-2xl font-black text-white">{{ $stats['upvotes_received'] ?? 0 }}</div>
                                </div>

                                {{-- Stat Item 3 --}}
                                <div class="bg-white/5 backdrop-blur-md rounded-2xl p-4 border border-white/5 hover:bg-white/10 transition group">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="p-2 rounded-lg bg-amber-500/20 text-amber-300 group-hover:text-amber-200 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5v14l7-3 7 3V5a2 2 0 00-2-2H7a2 2 0 00-2 2z" />
                                            </svg>
                                        </div>
                                        <span class="text-slate-400 text-xs font-bold uppercase tracking-wider">Saved</span>
                                    </div>
                                    <div class="text-2xl font-black text-white">{{ $stats['saved_count'] ?? 0 }}</div>
                                </div>

                                {{-- Stat Item 4 --}}
                                <div class="bg-white/5 backdrop-blur-md rounded-2xl p-4 border border-white/5 hover:bg-white/10 transition group">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="p-2 rounded-lg bg-sky-500/20 text-sky-300 group-hover:text-sky-200 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                            </svg>
                                        </div>
                                        <span class="text-slate-400 text-xs font-bold uppercase tracking-wider">Comments</span>
                                    </div>
                                    <div class="text-2xl font-black text-white">{{ $stats['comments_count'] ?? 0 }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-8 items-start">

            {{-- MAIN CONTENT: POSTS --}}
            <section class="col-span-12 lg:col-span-8 space-y-8">
                <div class="flex items-center justify-between pb-4 border-b border-slate-200">
                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight flex items-center gap-2">
                        Your Publications
                        <span class="bg-indigo-100 text-indigo-700 text-xs font-bold px-2.5 py-1 rounded-full">{{ $recentPosts->count() }}</span>
                    </h2>

                    {{-- Filter Dropdown Placeholder --}}
                    <div class="relative">
                        <button class="text-sm font-semibold text-slate-500 hover:text-slate-800 flex items-center gap-1 transition">
                            Newest First
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="space-y-6">
                    @forelse($recentPosts as $post)
                        <article class="group relative bg-white rounded-3xl p-4 border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-indigo-500/5 transition-all duration-300 ease-out hover:-translate-y-1">
                            <div class="flex flex-col sm:flex-row gap-5">
                                {{-- Thumbnail --}}
                                <div class="relative w-full sm:w-48 h-48 sm:h-auto shrink-0 rounded-2xl overflow-hidden">
                                    <div class="absolute inset-0 bg-slate-900/0 group-hover:bg-slate-900/10 transition z-10"></div>
                                    <img src="{{ $post->thumbnail ? Storage::url($post->thumbnail) : asset('/images/post.jpg') }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700" alt="{{ $post->title }}">

                                    {{-- Floating Edit Button --}}
                                    <button onclick="location.href='{{ route('posts.edit', $post->id) }}'" class="absolute top-2 right-2 bg-white/90 backdrop-blur text-slate-700 p-2 rounded-lg opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-300 z-20 hover:bg-indigo-50 hover:text-indigo-600 shadow-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                </div>

                                {{-- Content --}}
                                <div class="flex-1 py-1 pr-2 flex flex-col">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-center gap-2 mb-2">
                                            {{-- Use random colors for tags or dynamic based on ID --}}
                                            <span class="px-2.5 py-0.5 rounded-md bg-slate-100 text-slate-500 text-xs font-bold uppercase tracking-wider">Tech</span>
                                            <span class="text-slate-400 text-xs font-medium">{{ $post->created_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>

                                    <h3 class="text-xl font-bold text-slate-800 mb-2 leading-snug group-hover:text-indigo-600 transition">
                                        <a href="{{ route('posts.show', $post->id) }}">
                                            {{ $post->title }}
                                        </a>
                                    </h3>

                                    <p class="text-slate-500 text-sm line-clamp-2 leading-relaxed mb-auto">
                                        {{ $post->brief_description }}
                                    </p>

                                    {{-- Footer Meta --}}
                                    <div class="mt-4 pt-4 border-t border-slate-50 flex items-center justify-between">
                                        <div class="flex items-center gap-4 text-slate-500">
                                            <div class="flex items-center gap-1.5 text-sm font-medium" title="Upvotes">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-amber-500" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                                                </svg>
                                                {{ $post->upvote ?? 0 }}
                                            </div>
                                            <!-- downvote -->
                                            <div class="flex items-center gap-1.5 text-sm font-medium" title="Downvotes">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                                    <g transform="rotate(180, 10, 10)">
                                                        <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                                                    </g>
                                                </svg>
                                                {{ $post->downvote ?? 0 }}
                                            </div>

                                            <div class="flex items-center gap-1.5 text-sm font-medium" title="Comments">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd" />
                                                </svg>
                                                {{ $post->comments }}
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <button data-post-id="{{ $post->id }}" class="btn-save-toggle w-8 h-8 flex items-center justify-center rounded-full bg-slate-50 hover:bg-indigo-50 text-slate-400 hover:text-indigo-600 transition">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5v14l7-3 7 3V5a2 2 0 00-2-2H7a2 2 0 00-2 2z" />
                                                </svg>
                                            </button>
                                            <a href="{{ route('posts.show', $post->id) }}" class="text-sm font-bold text-slate-800 hover:text-indigo-600 flex items-center gap-1 transition">
                                                Read more
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="bg-white rounded-3xl p-10 border border-dashed border-slate-300 text-center">
                            <div class="inline-block p-4 rounded-full bg-indigo-50 text-indigo-500 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11l5-2 5 2V9a2 2 0 00-2-2h-1zM17 8l4 4m0 0l-4 4m4-4H7" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-800">No posts published yet</h3>
                            <p class="text-slate-500 mt-2 max-w-sm mx-auto">It looks a bit empty here. Share your first insight with the community!</p>
                            <div class="mt-6">
                                <a href="{{ route('posts.create') }}" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-full font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-500/30">Create Post</a>
                            </div>
                        </div>
                    @endforelse
                </div>
            </section>

            {{-- SIDEBAR: STICKY --}}
            <aside class="col-span-12 lg:col-span-4 space-y-6 lg:sticky lg:top-24">

                {{-- User ID Card --}}
                <div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
                    <div class="h-20 bg-slate-900 relative">
                        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
                        <div class="absolute -bottom-6 right-6 w-24 h-24 bg-indigo-500/20 rounded-full blur-xl"></div>
                    </div>
                    <div class="px-6 pb-6 -mt-10 relative">
                        <div class="flex justify-between items-end mb-4">
                            <div class="bg-white p-1 rounded-2xl shadow-sm inline-block">
                                <img src="{{ strpos($user->picture, 'https://') === 0 ? $user->picture : Storage::url($user->picture) }}" class="w-16 h-16 rounded-xl object-cover" alt="">
                            </div>
                            <span class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 text-xs font-bold uppercase tracking-wide border border-emerald-100">
                                {{ $user->status ?? 'Active' }}
                            </span>
                        </div>

                        <div>
                            <h3 class="font-bold text-slate-800 text-lg">{{ $user->name }}</h3>
                            <p class="text-slate-500 text-sm mb-4">{{ $user->email }}</p>

                            <div class="grid grid-cols-2 gap-2 mb-6">
                                <div class="bg-slate-50 rounded-xl p-3 text-center">
                                    <div class="text-slate-400 text-xs uppercase font-bold">Role</div>
                                    <div class="text-slate-800 font-bold">{{ $user->role ?? 'Member' }}</div>
                                </div>
                                <div class="bg-slate-50 rounded-xl p-3 text-center">
                                    <div class="text-slate-400 text-xs uppercase font-bold">Total Views</div>
                                    <div class="text-slate-800 font-bold">{{ number_format($stats['views'] ?? 0) }}</div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-2 mt-6">
                                <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                                    @csrf
                                    <button type="submit" id="logoutBtn" class="w-full py-3 rounded-xl border border-slate-200 text-slate-600 font-semibold text-sm hover:bg-red-50 hover:text-red-600 hover:border-red-100 transition flex items-center justify-center gap-2 group">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 group-hover:scale-110 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Saved Posts --}}
                <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-lg shadow-slate-200/50">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-slate-800 font-bold text-lg">Saved Reads</h4>
                        <a href="#" class="text-xs font-bold text-indigo-600 hover:text-indigo-700 uppercase tracking-wide">View All</a>
                    </div>

                    <div class="space-y-4">
                        @forelse($savedPosts->take(3) as $post)
                            <div class="flex gap-3 group">
                                <div class="shrink-0 w-16 h-16 rounded-xl overflow-hidden relative">
                                    <img src="{{ $post->thumbnail ? Storage::url($post->thumbnail) : asset('images/post.jpg') }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <a href="{{ route('posts.show', $post->id) }}" class="block text-sm font-bold text-slate-800 leading-snug hover:text-indigo-600 line-clamp-2 mb-1">
                                        {{ $post->title }}
                                    </a>
                                    <div class="flex items-center gap-2 text-xs text-slate-400">
                                        <span>{{ $post->created_at->diffForHumans(null, true) }}</span>
                                        <span>&bull;</span>
                                        <span>{{ $post->views }} reads</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4 text-slate-400 text-sm italic">
                                Nothing saved yet.
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Trending Tags --}}
                @if(isset($topTags) && count($topTags) > 0)
                    <div class="bg-linear-to-br from-indigo-500 to-violet-600 rounded-3xl p-6 text-white shadow-xl shadow-indigo-500/20 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-2xl -mr-10 -mt-10"></div>

                        <h4 class="font-bold text-lg mb-4 relative z-10">Trending Topics</h4>
                        <div class="flex flex-wrap gap-2 relative z-10">
                            @foreach($topTags as $tag)
                                <a href="#" class="px-3 py-1.5 rounded-lg bg-white/10 hover:bg-white/20 border border-white/10 text-sm font-medium transition backdrop-blur-sm">
                                    #{{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </aside>
        </div>
    </main>

    @push('scripts')
        <script>
            // Kept your original scripts logic, just ensure classes match if you target them.
            // Example: The '.btn-save-toggle' class is preserved in the HTML above.
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';
            const logoutForm = document.getElementById('logoutForm');
            document.getElementById('logoutBtn')?.addEventListener('click', (e) => {
                e.preventDefault();
                if (window.Swal) {
                    Swal.fire({
                        title: 'Ready to leave?',
                        text: 'You will be logged out of your session.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#4f46e5', // Indigo-600
                        cancelButtonColor: '#94a3b8', // Slate-400
                        confirmButtonText: 'Yes, log me out',
                        borderRadius: '1rem'
                    }).then(result => {
                        if (result.isConfirmed) {
                            performLogout();
                        }
                    });
                } else {
                    if (confirm('Logout?')) performLogout();
                }
            });

            function performLogout() {
                logoutForm.submit();
            }
        </script>
    @endpush
@endsection