<article class="relative group bg-white rounded-3xl p-3 border border-slate-100 shadow-card hover:shadow-card-hover transition-all duration-300 hover:-translate-y-1">
    <div class="relative h-48 rounded-2xl overflow-hidden mb-3 img-zoom-container">
        <img src="{{ $post->thumbnail ? Storage::url($post->thumbnail) : asset('images/post.jpg') }}" alt="Pottery" class="w-full h-full object-cover img-zoom">
        <div class="absolute top-3 right-3 z-10">
            @php
                $userLiked = $post->votes->first() && $post->votes->first()->liked;
            @endphp
            <button class="like-btn bg-white/90 backdrop-blur-sm p-2 rounded-full shadow-sm hover:scale-110 transition active:scale-95 hover:text-red-500 {{ $userLiked ? 'text-red-500 bg-red-50' : 'text-slate-400' }}" data-post-id="{{ $post->link }}">
                <svg class="w-5 h-5 {{ $userLiked ? 'fill-current' : '' }}" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                </svg>
            </button>
        </div>
    </div>

    <div class="px-1 pb-2">
        <div class="flex items-center gap-2 mb-2">
            <div class="bg-blue-50 text-blue-600 px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider">Class</div>
        </div>
        <h3 class="font-bold text-slate-800 text-lg leading-snug mb-1 group-hover:text-brand-600 transition-colors">{{ $post->title }}</h3>
        <p class="text-slate-500 text-sm line-clamp-2 mb-4">{{ $post->brief_description }}</p>

        <div class="flex items-center justify-between border-t border-slate-100 pt-3">
            <div class="flex items-center gap-2">
                <img src="{{ $post->author->picture ? Storage::url($post->author->picture) : asset('images/profile.jpg') }}" class="w-8 h-8 rounded-full object-cover ring-2 ring-white" alt="Avatar">
                <span class="text-xs font-semibold text-slate-700">{{ $post->author->name }}</span>
            </div>
            <div class="flex items-center gap-1 text-amber-500 text-xs font-bold">
                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                </svg>
                4.9 (82)
            </div>
        </div>
    </div>
    <a href="{{ route('posts.show', $post) }}" class="absolute inset-0 rounded-3xl z-0"></a>
</article>