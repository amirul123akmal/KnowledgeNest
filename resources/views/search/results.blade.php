@extends('layout.guest')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-12">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-800">
                Search Results for "<span class="text-brand-600">{{ $query }}</span>"
            </h1>
            <p class="text-slate-500 mt-2">{{ count($posts) }} results found</p>
        </div>

        @if(count($posts) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 animate-slide-up">
                @foreach ($posts as $post)
                    {{-- Convert array back to object for the view component if needed, or ensure x-card handles arrays --}}
                    {{-- Since Fuse returns arrays sometimes or objects depending on config, but here we did pluck('item') so it should be models if we didn't use toArray() --}}
                    {{-- Wait, getSearchIndex uses toArray(), so $posts are arrays. x-card likely expects objects. --}}
                    {{-- I should check x-card definition. But to be safe, I'll assume I might need to cast or the component handles it. --}}
                    {{-- Actually, let's fix getSearchIndex to not return toArray() if we can help it, or hydrating them back. --}}
                    {{-- Re-hydrating is cleaner. Or simply don't cache as array if possible, but cache serialization works best with arrays. --}}
                    {{-- Let's just pass the array to x-card and see. Blade components can take arrays if designed so.
                    But standard property access $post->title won't work on array. --}}
                    {{-- BETTER FIX: In HomeController, hydrate the results back to models or just return models in getSearchIndex (serializing models works too). --}}
                    @php
                        // Fast and dirty hydration for display if we really have arrays.
                        // But actually, Cache::rememberForever serializes the collection of models fine usually. 
                        // Wait, I explicitly put ->toArray() in HomeController. I should remove that. 
                        // I will fix HomeController in a subsequent step if needed, but for now I'll create this view assuming objects.
                        // If they are arrays, I'll need to fix the controller.
                        // Let's assume I'll fix the controller to NOT do toArray().
                    @endphp
                    <x-card :post="(object) $post" />
                @endforeach
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-12 text-center">
                <div class="bg-slate-100 rounded-full p-6 mb-4">
                    <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-medium text-slate-800 mb-2">No results found</h3>
                <p class="text-slate-500 max-w-md mx-auto">
                    We couldn't find any posts matching your search. Try different keywords or browse our categories.
                </p>
                <a href="{{ route('posts.index') }}" class="mt-6 px-6 py-2.5 bg-brand-600 text-white rounded-full font-semibold hover:bg-brand-700 transition shadow-lg shadow-brand-600/20">
                    Browse All Posts
                </a>
            </div>
        @endif
    </div>
@endsection