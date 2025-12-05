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

        /* Markdown content styling (clean, readable) */
        .markdown-content {
            color: #0f172a;
            line-height: 1.7;
        }

        .markdown-content h1 {
            font-size: 1.6rem;
            margin-top: 1.2rem;
            margin-bottom: .6rem;
            font-weight: 700;
        }

        .markdown-content h2 {
            font-size: 1.25rem;
            margin-top: 1rem;
            margin-bottom: .5rem;
            font-weight: 700;
        }

        .markdown-content p {
            margin-bottom: .9rem;
            color: #334155;
        }

        .markdown-content ul,
        .markdown-content ol {
            padding-left: 1.2rem;
            margin-bottom: .9rem;
            color: #334155;
        }

        .markdown-content blockquote {
            border-left: 4px solid rgba(139, 92, 246, 0.12);
            padding-left: .9rem;
            color: #475569;
            background: rgba(139, 92, 246, 0.03);
            border-radius: .375rem;
            margin: .6rem 0;
        }

        .markdown-content pre {
            background: #0b1220;
            color: #e6edf3;
            padding: 1rem;
            border-radius: .5rem;
            overflow: auto;
            font-size: .92rem;
            margin-bottom: 1rem;
        }

        .markdown-content code {
            background: rgba(15, 23, 42, 0.04);
            padding: .15rem .35rem;
            border-radius: .25rem;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, "Roboto Mono", "Helvetica Neue", monospace;
        }

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

        /* responsive: ensure content column readable on mobile */
        @media (min-width: 1024px) {
            .content-max {
                max-width: 65ch;
            }
        }
    </style>
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
                                            @foreach ($post->tags as $tag)
                                                <span class="tag">{{ $tag['value'] }}</span>
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
                    <div id="content" class="markdown-content content-max"></div>
                </div>

                <!-- feedback & share -->
                <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <button id="saveBtn" class="px-3 py-2 rounded-lg bg-white border text-sm hover:shadow">Save</button>
                        <button id="shareBtn" class="px-3 py-2 rounded-lg bg-white border text-sm hover:shadow">Share</button>
                    </div>

                    <div class="text-sm text-slate-500">Tags:
                        @foreach ($post->tags as $tag)
                            <span class="ml-2"><span class="tag">{{ $tag['value'] }}</span></span>
                        @endforeach
                    </div>
                </div>

                <!-- comments area -->
                <section class="mt-6 glass rounded-2xl p-5 shadow-card border border-white/60">
                    <h3 class="text-lg font-semibold mb-3">Comments</h3>

                    <!-- new comment form -->
                    <form id="commentForm" class="space-y-3">
                        <textarea id="commentInput" required placeholder="Write a friendly comment..." class="w-full rounded-lg border border-slate-200 p-3 text-sm" rows="3"></textarea>
                        <div class="flex items-center justify-between">
                            <div class="text-xs text-slate-400">Be kind and helpful — neighbours appreciate clear, respectful feedback.</div>
                            <div>
                                <button type="submit" class="px-4 py-2 rounded-lg bg-primary-500shadow">Post comment</button>
                            </div>
                        </div>
                    </form>

                    <!-- comments list -->
                    <div id="commentsList" class="mt-4 space-y-4">
                        <!-- sample comment -->
                        <div class="flex gap-3">
                            <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=200&auto=format&fit=crop" alt="c" class="w-10 h-10 rounded-md object-cover" />
                            <div class="bg-white rounded-lg p-3 shadow-sm flex-1">
                                <div class="flex items-center justify-between">
                                    <div class="text-sm font-semibold">Jamie</div>
                                    <div class="text-xs text-slate-400">2 days ago</div>
                                </div>
                                <p class="text-sm text-slate-700 mt-1">Great post — tried this bench pattern and it turned out sturdy. Thanks for clear steps!</p>
                            </div>
                        </div>
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

    <!-- SCRIPT -->
    <script>
        @onload
        // demo markdown content (replace with server content in production)
        const sampleMarkdown = `# Build a DIY Plywood Bench
                                                                                                            A simple, sturdy bench ideal for patios, entryways, or as a companion to your workbench.
                                                                                                            ## Tools & Materials
                                                                                                            - 18mm plywood sheets
                                                                                                            - Wood glue
                                                                                                            - Screws (30 mm)
                                                                                                            - Sandpaper (120/220)
                                                                                                            - Finish of your choice
                                                                                                            ## Steps
                                                                                                            1. Cut panels to size.
                                                                                                            2. Assemble the legs and attachments.
                                                                                                            3. Sand all surfaces.
                                                                                                            4. Apply finish and let dry.
                                                                                                            > Tip: Use a spacer block to get consistent gaps.
                                                                                                            \`\`\`js
                                                                                                            // example: calculate bench width
                                                                                                            function benchWidth(seat, overhang) {
                                                                                                              return seat + (2 * overhang);
                                                                                                            }
                                                                                                            \`\`\`
                                                                                                            Enjoy your new bench — post a photo when you're done!`;

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

        // interaction: votes & likes
        let votes = {{ $post->upvote - $post->downvote }};
        let likes = {{ $post->likes }};
        let userVote = {{ $userVote ? $userVote->vote : 0 }}; // 1 upvoted, -1 downvoted, 0 neutral
        let userLiked = {{ $userVote && $userVote->liked ? 'true' : 'false' }};

        const voteCountEl = document.getElementById('voteCount');
        const upvoteBtn = document.getElementById('upvoteBtn');
        const downvoteBtn = document.getElementById('downvoteBtn');
        const likeBtn = document.getElementById('likeBtn');
        const likesCountEl = document.getElementById('likesCount');
        const likeIcon = document.getElementById('likeIcon');
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

        // Initialize UI
        updateVotesUI();
        updateLikesUI();

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
                if (res.status === 401) {
                    window.location.href = "{{ route('login.index') }}";
                    return;
                }
                if (res.status === 302) {
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
                console.log(res.status);
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
                if (res.status === 401) {
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

        // comments: basic add / list (client-only demo)
        const commentForm = document.getElementById('commentForm');
        const commentInput = document.getElementById('commentInput');
        const commentsList = document.getElementById('commentsList');

        commentForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const txt = commentInput.value.trim();
            if (!txt) return alert('Write a comment first.');
            const now = new Date();
            const container = document.createElement('div');
            container.className = 'flex gap-3';
            container.innerHTML = `
                                                                                                                                                                                                            <img src="https://images.unsplash.com/photo-1502685104226-ee32379fefbe?q=80&w=200&auto=format&fit=crop" alt="user" class="w-10 h-10 rounded-md object-cover"/>
                                                                                                                                                                                                            <div class="bg-white rounded-lg p-3 shadow-sm flex-1">
                                                                                                                                                                                                              <div class="flex items-center justify-between">
                                                                                                                                                                                                                <div class="text-sm font-semibold">You</div>
                                                                                                                                                                                                                <div class="text-xs text-slate-400">${now.toLocaleString()}</div>
                                                                                                                                                                                                              </div>
                                                                                                                                                                                                              <p class="text-sm text-slate-700 mt-1">${escapeHtml(txt)}</p>
                                                                                                                                                                                                            </div>
                                                                                                                                                                                                          `;
            commentsList.prepend(container);
            commentInput.value = '';
        });

        function escapeHtml(str) {
            return str.replace(/[&<>"]/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c]));
        }

        // update small info fields
        updateVotesUI();
        updateLikesUI();

        // fetch real content demo: In production you would request the post markdown from backend and render it
        // Example:
        // fetch('/api/posts/123').then(r => r.json()).then(data => {
        //   document.getElementById('postTitle').textContent = data.title;
        //   document.getElementById('authorName').textContent = data.author.name;
        //   contentEl.innerHTML = marked.parse(data.markdown);
        // });
        @endonload
    </script>
@endsection