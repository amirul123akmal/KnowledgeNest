@extends('layout.guest')

@section('content')
    <!-- Marked for Markdown rendering + highlight.js for code highlighting -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/github-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/highlight.min.js"></script>

    <style>
        .glass {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.78), rgba(255, 255, 255, 0.62));
            backdrop-filter: blur(6px);
        }

        /* Markdown content styling handled by @tailwindcss/typography (prose) */

        .tag {
            background: #f1efff;
            color: #5b21b6;
            padding: .2rem .5rem;
            border-radius: 999px;
            font-size: .75rem;
            font-weight: 600;
        }

        .meta-pill {
            background: rgba(15, 23, 42, 0.04);
            padding: .35rem .6rem;
            border-radius: .5rem;
            font-size: .85rem;
            color: #334155;
        }

        /* small utilities */
        .vote-btn {
            width: 44px;
            height: 44px;
            border-radius: .6rem;
        }

        .author-bubble {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            object-fit: cover;
        }
    </style>
    @php
        $profilePic = auth()->user()->picture ? Storage::url(auth()->user()->picture) : asset('images/avatar-placeholder.png');
    @endphp
    <!-- BODY -->
    <main class="py-8 px-4 sm:px-6 lg:px-12 pt-24 pb-20 [&_button]:cursor-pointer">
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- main content column -->
            <article class="lg:col-span-2 space-y-6">
                <div class="glass rounded-2xl p-5 shadow-card border border-white/60">
                    <div class="flex flex-col sm:flex-row sm:items-start gap-4">
                        <div class="flex flex-col items-center gap-3">
                            <!-- votes / likes -->
                            <div class="flex flex-col items-center bg-white rounded-2xl p-2 shadow-sm">
                                <button id="upvoteBtn" class="vote-btn flex items-center justify-center text-slate-600 hover:bg-slate-50">
                                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 5l7 7H5l7-7z" />
                                    </svg>
                                </button>
                                <div id="voteCount" class="text-sm font-semibold mt-1">120</div>
                                <button id="downvoteBtn" class="vote-btn mt-1 flex items-center justify-center text-slate-600 hover:bg-slate-50">
                                    <svg class="w-6 h-6 transform rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 5l7 7H5l7-7z" />
                                    </svg>
                                </button>
                            </div>

                            <button id="likeBtn" class="px-3 py-2 rounded-lg bg-white border shadow-sm flex items-center gap-2 text-sm">
                                <svg id="likeIcon" class="w-5 h-5 text-rose-500" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 21s-7-4.35-9-7.05C-0.23 9.95 4 4.5 8.5 6.5 10.7 7.5 12 9 12 9s1.3-1.5 3.5-2c4.5-2 8.73 3.45 5.5 7.45-2 2.7-9 7.05-9 7.05z" />
                                </svg>
                                <span id="likesCount">340</span>
                            </button>
                        </div>
                        <!-- thumbnail -->
                        <div class="shrink-0">
                            <img id="postThumbnail" src="https://images.unsplash.com/photo-1519710164239-da123dc03ef4?q=80&w=1200&auto=format&fit=crop" alt="thumbnail" class="w-full sm:w-40 h-28 object-cover rounded-lg shadow-sm" />
                        </div>

                        <div class="flex-1">

                            <!-- title & meta -->
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h1 id="postTitle" class="text-2xl md:text-3xl font-extrabold text-slate-800">{{ $post->title }}</h1>

                                    <div class="mt-2 flex flex-wrap gap-2 items-center">
                                        <div class="meta-pill">Difficulty: <strong class="ml-2">{{ ucfirst($post->difficulty) }}</strong></div>
                                        <div class="meta-pill">Views: <strong class="ml-2" id="viewsCount">{{ $post->views }}</strong></div>
                                        <div class="meta-pill">⏱️ 18 min read</div>
                                        <div class="flex items-center gap-2">
                                            @foreach (json_decode($post->tags, true) as $tag)
                                                <span class="tag">{{ $tag["value"] }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- author -->
                            <div class="mt-3 flex items-center gap-3">
                                <img src="{{ $post->author->picture ? Storage::url($post->author->picture) : asset('images/profile.jpg') }}" alt="author" class="author-bubble" />
                                <div>
                                    <div class="text-sm font-semibold" id="authorName">{{ $post->author->name }}</div>
                                    <div class="text-xs text-slate-500">Published <time datetime="2025-02-12" id="publishDate">{{ $post->created_at->format('F j, Y') }}</time> • <span id="readTime">18 min</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- markdown content -->
                <div class="glass rounded-2xl p-6 shadow-card border border-white/60">
                    <div id="content" class="prose prose-lg prose-slate w-full max-w-none prose-headings:font-bold prose-headings:text-slate-800 prose-p:text-slate-600 prose-p:leading-relaxed prose-a:text-primary-600 prose-a:no-underline hover:prose-a:underline prose-img:rounded-2xl prose-img:shadow-md prose-img:my-8 prose-pre:bg-slate-900 prose-pre:shadow-lg prose-pre:rounded-xl prose-blockquote:border-l-4 prose-blockquote:border-l-primary-500 prose-blockquote:bg-purple-50/50 prose-blockquote:py-2 prose-blockquote:px-4 prose-blockquote:rounded-r-lg prose-blockquote:not-italicfont-sans"></div>
                </div>

                <!-- feedback & share -->
                <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <button id="saveBtn" class="px-3 py-2 rounded-lg bg-white border text-sm hover:shadow">Save</button>
                        <button id="shareBtn" class="px-3 py-2 rounded-lg bg-white border text-sm hover:shadow">Share</button>
                    </div>

                    <div class="text-sm text-slate-500">Tags:
                        @foreach (json_decode($post->tags, true) as $tag)
                            <span class="ml-2"><span class="tag">{{ $tag['value'] }}</span></span>
                        @endforeach
                    </div>
                </div>

                <!-- comments area -->
                <section class="mt-6 glass rounded-2xl p-5 shadow-card border border-white/60">
                    <h3 class="text-lg font-semibold mb-3">Comments ({{ $post->comments }})</h3>

                    <!-- new comment form -->
                    <form id="commentForm" class="space-y-3" action="{{ route('posts.comment.store', $post->link) }}" method="POST">
                        @csrf
                        @method('POST')
                        <textarea id="commentInput" name="comment" required placeholder="Write a friendly comment..." class="w-full rounded-lg border border-slate-200 p-3 text-sm" rows="3"></textarea>
                        <div class="flex items-center justify-between">
                            <div class="text-xs text-slate-400">Be kind and helpful — neighbours appreciate clear, respectful feedback.</div>
                            <div>
                                <button type="submit" class="px-4 py-2 rounded-lg bg-primary-500 shadow">Post comment</button>
                            </div>
                        </div>
                    </form>

                    <div id="commentsList" class="mt-6 space-y-6">
                        {{-- Note: In your controller, ensure you fetch parent comments only, e.g., ->whereNull('parent_id') --}}
                        @forelse($post->comments()->latest()->get() as $comment)

                            {{-- PARENT COMMENT --}}
                            <div class="group">
                                <div class="flex gap-4">
                                    {{-- User Avatar --}}
                                    <div class="shrink-0">
                                        <img src="{{ $comment->author->picture ? Storage::url($comment->author->picture) : asset('images/avatar-placeholder.png') }}" alt="{{ $comment->author->name }}" class="w-10 h-10 rounded-full object-cover border border-slate-200 shadow-sm" />
                                    </div>

                                    {{-- Comment Body --}}
                                    <div class="flex-1">
                                        {{-- Bubble --}}
                                        <div class="bg-white rounded-2xl rounded-tl-none p-4 border border-slate-200 shadow-sm relative">
                                            <div class="flex items-center justify-between mb-2">
                                                <div class="flex items-center gap-2">
                                                    <span class="font-bold text-slate-800 text-sm">{{ $comment->author->name }}</span>
                                                    @if($comment->author->id === $post->user_id)
                                                        <span class="bg-indigo-100 text-indigo-700 text-[10px] font-bold px-1.5 py-0.5 rounded-full">Author</span>
                                                    @endif
                                                </div>
                                                <span class="text-xs text-slate-400 font-medium">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>

                                            <p class="text-slate-600 text-sm leading-relaxed">
                                                {{ $comment->comment }}
                                            </p>
                                        </div>

                                        {{-- Action Bar: Votes & Reply --}}
                                        <div class="flex items-center gap-6 mt-1.5 ml-2">
                                            {{-- Vote Controls --}}
                                            <div class="flex items-center bg-slate-50 rounded-full px-2 py-1 border border-slate-100">
                                                {{-- Upvote --}}
                                                <button class="p-1 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-full transition" title="Upvote">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="m18 15-6-6-6 6" />
                                                    </svg>
                                                </button>

                                                {{-- Score --}}
                                                <span class="text-xs font-bold text-slate-700 mx-1 min-w-5 text-center">
                                                    {{ $comment->upvotes_count ?? 0 }}
                                                </span>

                                                {{-- Downvote --}}
                                                <button class="p-1 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-full transition" title="Downvote">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="m6 9 6 6 6-6" />
                                                    </svg>
                                                </button>
                                            </div>

                                            {{-- Reply Button --}}
                                            <button onclick="document.getElementById('reply-form-{{ $comment->id }}').classList.toggle('hidden')" class="flex items-center gap-1.5 text-xs font-bold text-slate-500 hover:text-indigo-600 transition">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                                                </svg>
                                                Reply
                                            </button>
                                        </div>

                                        {{-- Hidden Reply Form --}}
                                        <div id="reply-form-{{ $comment->id }}" class="hidden mt-4 ml-2 animate-fade-in-down">
                                            <form action="{{ route('comments.reply', $comment->id) }}" method="POST" class="flex gap-3">
                                                @csrf
                                                <img src="{{ $profilePic }}" class="w-8 h-8 rounded-full object-cover">
                                                <div class="flex-1">
                                                    <textarea name="reply" rows="1" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition resize-none" placeholder="Write a reply..."></textarea>
                                                    <div class="flex justify-end mt-2">
                                                        <button type="submit" class="bg-indigo-600 text-white text-xs font-bold px-3 py-1.5 rounded-lg hover:bg-indigo-700 transition">Post Reply</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        {{-- NESTED REPLIES (Recursive UI) --}}
                                        @if($comment->replies && $comment->replies->count() > 0)
                                            <div class="mt-4 pl-4 border-l-2 border-slate-100 space-y-4">
                                                @foreach($comment->replies as $reply)
                                                    <div class="flex gap-3">
                                                        {{-- Reply Avatar (Smaller) --}}
                                                        <img src="{{ $reply->author->picture ? Storage::url($reply->author->picture) : asset('images/avatar-placeholder.png') }}" class="w-8 h-8 rounded-full object-cover border border-white shadow-sm" />

                                                        <div class="flex-1">
                                                            <div class="bg-slate-50 rounded-xl p-3 border border-slate-100">
                                                                <div class="flex items-center justify-between mb-1">
                                                                    <span class="font-bold text-slate-800 text-xs">{{ $reply->author->name }}</span>
                                                                    <span class="text-[10px] text-slate-400">{{ $reply->created_at->diffForHumans() }}</span>
                                                                </div>
                                                                <p class="text-slate-600 text-sm">{{ $reply->comment }}</p>
                                                            </div>

                                                            {{-- Reply Actions (Minimal) --}}
                                                            <div class="flex items-center gap-4 mt-1 ml-2">
                                                                <div class="flex items-center gap-1">
                                                                    <button class="text-slate-400 hover:text-emerald-600"><svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                                            <path d="m18 15-6-6-6 6" />
                                                                        </svg></button>
                                                                    <span class="text-[10px] font-bold text-slate-600">{{ $reply->upvotes_count ?? 0 }}</span>
                                                                    <button class="text-slate-400 hover:text-red-500"><svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                                            <path d="m6 9 6 6 6-6" />
                                                                        </svg></button>
                                                                </div>
                                                                <button class="text-[10px] font-bold text-slate-500 hover:text-indigo-600">Reply</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        @empty
                            <div class="text-center py-12 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                                <div class="text-slate-400 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                </div>
                                <p class="text-slate-500 font-medium">No comments yet</p>
                                <p class="text-slate-400 text-sm">Start the conversation!</p>
                            </div>
                        @endforelse
                    </div>
                </section>
            </article>

            <!-- right sidebar: related posts & quick info -->
            <aside class="space-y-6">
                <div class="glass rounded-2xl p-4 shadow-card border border-white/60">
                    <div class="flex items-center justify-between mb-3">
                        <div class="text-sm text-slate-500">Quick info</div>
                        <div class="text-xs text-slate-400">Share & explore</div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <div class="text-xs text-slate-500">Difficulty</div>
                            <div class="text-sm font-semibold">{{ $post->difficulty }}</div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="text-xs text-slate-500">Views</div>
                            <div class="text-sm font-semibold" id="viewsSmall">{{ $post->views }}</div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="text-xs text-slate-500">Likes</div>
                            <div class="text-sm font-semibold" id="likesSmall">{{ $post->likes }}</div>
                        </div>
                    </div>
                </div>

                <div class="glass rounded-2xl p-4 shadow-card border border-white/60">
                    <div class="flex items-center justify-between mb-3">
                        <div class="text-sm font-semibold">Related posts</div>
                        <a href="#" class="text-xs text-primary-700">See all</a>
                    </div>

                    <ul class="space-y-3">
                        <li class="flex items-center gap-3">
                            <img src="https://images.unsplash.com/photo-1533089860892-a7f5749c0f5b?q=80&w=200&auto=format&fit=crop" alt="" class="w-14 h-10 object-cover rounded-md" />
                            <div>
                                <a href="#" class="font-medium text-slate-800 text-sm">Quick sanding tips for smooth finish</a>
                                <div class="text-xs text-slate-400">• 12 min</div>
                            </div>
                        </li>

                        <li class="flex items-center gap-3">
                            <img src="https://images.unsplash.com/photo-1508253578933-2f9a8d21f3c8?q=80&w=200&auto=format&fit=crop" alt="" class="w-14 h-10 object-cover rounded-md" />
                            <div>
                                <a href="#" class="font-medium text-slate-800 text-sm">Choosing the right plywood</a>
                                <div class="text-xs text-slate-400">• Beginner</div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="glass rounded-2xl p-4 shadow-card border border-white/60">
                    <div class="text-sm font-semibold mb-2">About the author</div>
                    <div class="flex items-center gap-3">
                        <img src="{{ Storage::url($post->author->picture) }}" class="w-12 h-12 rounded-lg object-cover" alt="author" />
                        <div>
                            <div class="font-medium">{{ $post->author->name }}</div>
                            <div class="text-xs text-slate-500">Neighbour • Woodworker • Organizer</div>
                            <div class="mt-2">
                                <a href="#" class="text-xs text-primary-700">View profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </main>

    <!-- DATA -->
    <script id="markdown-content" type="application/json">
                        {!! json_encode($post->content, JSON_HEX_TAG) !!}
                    </script>

    <!-- SCRIPT -->
    <script>
        @onload
        // interaction: votes & likes
        let votes = {{ $post->upvote - $post->downvote }};
        let likes = {{ $post->likes }};
        let userVote = {{ $userVote ? $userVote->vote : 0 }}; // 1 upvoted, -1 downvoted, 0 neutral
        let userLiked = {{ $userVote && $userVote->liked ? 'true' : 'false' }};
        let isSaved = {{ $isSaved ? 'true' : 'false' }};

        const voteCountEl = document.getElementById('voteCount');
        const upvoteBtn = document.getElementById('upvoteBtn');
        const downvoteBtn = document.getElementById('downvoteBtn');
        const likeBtn = document.getElementById('likeBtn');
        const likesCountEl = document.getElementById('likesCount');
        const likeIcon = document.getElementById('likeIcon');
        const saveBtn = document.getElementById('saveBtn');
        const postId = "{{ $post->link }}";

        function updateVotesUI() {
            voteCountEl.textContent = votes;
            if (userVote === 1) {
                upvoteBtn.classList.add('bg-primary-50');
                downvoteBtn.classList.remove('bg-primary-50');
            } else if (userVote === -1) {
                downvoteBtn.classList.add('bg-primary-50');
                upvoteBtn.classList.remove('bg-primary-50');
            } else {
                upvoteBtn.classList.remove('bg-primary-50');
                downvoteBtn.classList.remove('bg-primary-50');
            }
        }

        function updateLikesUI() {
            likesCountEl.textContent = likes;
            document.getElementById('likesSmall').textContent = likes;
            if (userLiked) {
                likeBtn.classList.add('bg-rose-50');
                likeIcon.classList.add('fill-current');
            } else {
                likeBtn.classList.remove('bg-rose-50');
                likeIcon.classList.remove('fill-current');
            }
        }

        function updateSavedUI() {
            if (isSaved) {
                saveBtn.textContent = 'Saved';
                saveBtn.classList.add('bg-slate-800', 'text-white', 'border-transparent');
                saveBtn.classList.remove('bg-white', 'text-slate-700', 'border');
            } else {
                saveBtn.textContent = 'Save';
                saveBtn.classList.remove('bg-slate-800', 'text-white', 'border-transparent');
                saveBtn.classList.add('bg-white', 'text-slate-700', 'border');
            }
        }

        // Initialize UI
        updateVotesUI();
        updateLikesUI();
        updateSavedUI();

        // demo markdown content (replace with server content in production)
        const sampleMarkdown = JSON.parse(document.getElementById('markdown-content').textContent);

        // render markdown into #content
        const contentEl = document.getElementById('content');
        // enable code highlighting in marked
        marked.setOptions({
            highlight: function (code, lang) {
                try {
                    return hljs.highlightAuto(code, lang ? [lang] : undefined).value;
                } catch (e) {
                    return hljs.highlightAuto(code).value;
                }
            }
        });
        contentEl.innerHTML = marked.parse(sampleMarkdown);

        async function sendVote(val) {
            try {
                const res = await fetch(`/posts/${postId}/vote`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ vote: val })
                });
                if (res.status === 401 || res.status === 302) {
                    window.location.href = "{{ route('login.index') }}";
                    return;
                }
                const data = await res.json();
                if (data.success) {
                    votes = data.upvotes - data.downvotes;
                    userVote = data.user_vote;
                    updateVotesUI();
                }
            } catch (e) {
                console.log(e);
            }
        }

        upvoteBtn.addEventListener('click', () => sendVote(1));
        downvoteBtn.addEventListener('click', () => sendVote(-1));

        likeBtn.addEventListener('click', async () => {
            try {
                const res = await fetch(`/posts/${postId}/like`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({})
                });
                if (res.status === 401 || res.status === 302) {
                    window.location.href = "{{ route('login.index') }}";
                    return;
                }
                const data = await res.json();
                if (data.success) {
                    likes = data.likes;
                    userLiked = data.liked;
                    updateLikesUI();
                }
            } catch (e) {
                console.error(e);
            }
        });

        saveBtn.addEventListener('click', async () => {
            try {
                const res = await fetch(`/posts/${postId}/save`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({})
                });
                if (res.status === 401 || res.status === 302) {
                    window.location.href = "{{ route('login.index') }}";
                    return;
                }
                const data = await res.json();
                if (data.success) {
                    isSaved = data.is_saved;
                    updateSavedUI();
                }
            } catch (e) {
                console.error(e);
            }
        });
        const commentForm = document.getElementById('commentForm');
        const commentInput = document.getElementById('commentInput');
        const commentsList = document.getElementById('commentsList');

        commentForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const txt = commentInput.value.trim();
            if (!txt) return alert('Write a comment first.');
            commentForm.submit();
        });

        function escapeHtml(str) {
            return str.replace(/[&<>"]/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c]));
        }

        // update small info fields
        updateVotesUI();
        updateLikesUI();
        @endonload
    </script>
@endsection