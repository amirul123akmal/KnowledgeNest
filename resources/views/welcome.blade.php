@extends('layout.guest')
@section('content')
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-12">
    <!-- Hero Section: Bento Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-16 animate-fade-in">

      <!-- Main Hero Card -->
      <div class="lg:col-span-8 bg-brand-900 rounded-4xl p-8 md:p-12 relative overflow-hidden group min-h-[400px] flex flex-col justify-center border-2 border-indigo-500/50">
        <!-- Abstract Background -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-brand-500/30 rounded-full blur-3xl group-hover:bg-brand-500/40 transition-colors duration-700">
        </div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-indigo-600/30 rounded-full blur-3xl"></div>

        <div class="relative z-10 max-w-lg">
          <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-brand-100 text-xs font-semibold backdrop-blur-md mb-6 border border-white/10">
            <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
            Live in your area
          </div>
          <h1 class="text-4xl md:text-6xl font-extrabold text-black/20 tracking-tight leading-[1.1] mb-6">
            Share skills.<br>
            <span class="text-transparent bg-clip-text bg-linear-to-r from-brand-500 to-indigo-500">Shop local.</span>
          </h1>
          <p class="text-brand-100 text-lg mb-8 leading-relaxed">
            The neighborhood marketplace for trading talents, discovering hobbies, and supporting local side-hustles.
          </p>
          <div class="flex flex-wrap gap-4">
            <button class="bg-white text-brand-900 px-8 py-3.5 rounded-full font-bold hover:bg-brand-50 transition shadow-xl shadow-brand-900/20 flex items-center gap-2 group-hover:scale-105 duration-200">
              Start Exploring
              <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
              </svg>
            </button>
            <button class="px-8 py-3.5 rounded-full font-bold text-white border border-white/20 hover:bg-white/10 transition backdrop-blur-sm">
              List a Service
            </button>
          </div>
        </div>

        <!-- Decorative Floating Image -->
        <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=600&auto=format&fit=crop" class="absolute -right-12 bottom-12 w-64 h-64 object-cover rounded-2xl shadow-2xl -rotate-6 border-4 border-white/10 hidden md:block animate-float" alt="User teaching">
      </div>

      <!-- Right Column: Stats & Trending -->
      <div class="lg:col-span-4 flex flex-col gap-6">

        <!-- Trending Card -->
        <div class="bg-white rounded-4xl p-6 border border-slate-100 shadow-card flex-1 relative overflow-hidden group">
          <div class="flex justify-between items-center mb-4">
            <h3 class="font-bold text-lg text-slate-800">Trending Now</h3>
            <span class="text-2xl">🔥</span>
          </div>
          <div class="space-y-4 relative z-10">
            @forelse($trendingTags as $tag)
              <a href="{{ route('welcome.index', ['tags' => $tag['name']]) }}" class="flex items-center gap-4 p-3 rounded-xl bg-slate-50 hover:bg-brand-50 transition cursor-pointer group/item">
                <span class="text-2xl group-hover/item:scale-110 transition">{{ $tag['icon'] }}</span>
                <div>
                  <div class="font-bold text-slate-700">{{ ucfirst($tag['name']) }}</div>
                  <div class="text-xs text-slate-500">{{ $tag['count'] }} new listing{{ $tag['count'] !== 1 ? 's' : '' }}</div>
                </div>
              </a>
            @empty
              <div class="text-center text-slate-500 text-sm py-4">
                No trending tags yet
              </div>
            @endforelse
          </div>
        </div>

        <!-- Community Stat Card -->
        <div class="bg-linear-to-br from-indigo-500 to-purple-600 rounded-4xl p-6 text-white shadow-lg shadow-indigo-500/20 relative overflow-hidden">
          <svg class="absolute top-0 right-0 text-white/10 w-32 h-32 -mr-8 -mt-8" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2a10 10 0 1010 10A10 10 0 0012 2zm0 18a8 8 0 118-8 8 8 0 01-8 8z" />
          </svg>
          <div class="relative z-10">
            <div class="text-indigo-100 font-medium mb-1">Active Neighbors</div>
            <div class="text-4xl font-extrabold mb-4">2,408</div>
            <div class="flex -space-x-3">
              <img class="w-10 h-10 rounded-full border-2 border-indigo-500" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop" alt="">
              <img class="w-10 h-10 rounded-full border-2 border-indigo-500" src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=100&h=100&fit=crop" alt="">
              <img class="w-10 h-10 rounded-full border-2 border-indigo-500" src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop" alt="">
              <div class="w-10 h-10 rounded-full border-2 border-indigo-500 bg-white text-indigo-600 flex items-center justify-center text-xs font-bold">
                +2k</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="filters"></div>

    <!-- Filters / Sticky Header -->
    <!-- Filters / Sticky Header -->
    <div class="sticky top-24 z-30 mb-8">
      <div class="bg-white/80 backdrop-blur-md rounded-2xl p-2 shadow-sm border border-slate-200/60">
        <div class="flex items-center gap-2 overflow-x-auto no-scrollbar p-1">
          <!-- All Listings Button -->
          <a href="{{ route('welcome.index', array_filter(['tags' => null])) }}" class="px-4 py-2 rounded-xl text-sm font-semibold shadow-md whitespace-nowrap transition {{ empty($selectedTags) ? 'bg-slate-900 text-white' : 'bg-white text-slate-600 hover:bg-slate-100' }}">
            All Listings
          </a>

          <!-- Dynamic Tag Buttons -->
          @foreach($allTags as $tag)
            @php
              $isSelected = in_array($tag, $selectedTags);
              $newTags = $isSelected
                ? array_diff($selectedTags, [$tag])
                : array_merge($selectedTags, [$tag]);
              $tagsParam = !empty($newTags) ? implode(',', $newTags) : null;
              $color = \App\Http\Controllers\HomeController::getTagColor($tag);
            @endphp
            <a href="{{ route('welcome.index', array_filter(['tags' => $tagsParam])) }}" class="px-4 py-2 rounded-xl text-sm font-medium whitespace-nowrap transition {{ $isSelected ? $color['bg'] . ' ' . $color['text'] . ' font-semibold' : 'bg-white text-slate-600 hover:bg-slate-100' }}">
              {{ $tag }}
            </a>
          @endforeach
        </div>
      </div>
    </div>

    <!-- Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 animate-slide-up" id="posts-grid">
      @forelse ($posts as $post)
        <x-card :post="$post" />
      @empty
        <div class="col-span-full text-center py-12">
          <div class="text-6xl mb-4">🔍</div>
          <h3 class="text-xl font-bold text-slate-800 mb-2">No posts found</h3>
          <p class="text-slate-500 mb-4">Try selecting different tags or view all listings</p>
          <a href="{{ route('posts.index') }}" class="inline-block px-6 py-3 bg-brand-600 text-white rounded-xl font-semibold hover:bg-brand-700 transition">
            View All Listings
          </a>
        </div>
      @endforelse

      <!-- CTA Card -->
      @if($posts->count() > 0)
        <div class="bg-slate-50 rounded-3xl p-6 border-2 border-dashed border-slate-200 flex flex-col items-center justify-center text-center hover:border-brand-300 hover:bg-brand-50/50 transition duration-300 cursor-pointer group">
          <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center text-brand-500 mb-4 group-hover:scale-110 transition duration-300 group-hover:text-brand-600">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
          </div>
          <h3 class="text-lg font-bold text-slate-800 mb-2">Add Your Skill</h3>
          <p class="text-sm text-slate-500 mb-4">Join 2,000+ neighbors sharing their talents.</p>
          <button class="text-brand-600 font-bold text-sm group-hover:underline">Create listing &rarr;</button>
        </div>
      @endif
    </div>

    <!-- Pagination -->
    @if($posts->hasPages())
      <div class="mt-12">
        {{ $posts->links() }}
      </div>
    @endif
  </main>
  <script>
    // Simple interactions
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const closeMenuBtn = document.getElementById('closeMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    function toggleMenu() {
      if (mobileMenu.classList.contains('translate-x-full')) {
        mobileMenu.classList.remove('translate-x-full');
      } else {
        mobileMenu.classList.add('translate-x-full');
      }
    }

    if (mobileMenuBtn && closeMenuBtn && mobileMenu) {
      mobileMenuBtn.addEventListener('click', toggleMenu);
      closeMenuBtn.addEventListener('click', toggleMenu);
    }

    // Login Success Alert
    @onload
    @if (session('success'))
      Swal.fire({
        icon: 'success',
        title: 'Welcome Back!',
        text: "{{ session('success') }}",
        timer: 3000,
        showConfirmButton: false,
      });
    @endif

                      const likeBtn = document.getElementsByClassName('like-btn');
    document.querySelectorAll('.like-btn').forEach((btn, idx) => {
      const postId = btn.dataset.postId;
      btn.addEventListener('click', async (evt) => {
        console.group(`Like click: postId=${postId}`);
        try {
          const url = `/posts/${postId}/like`;
          const res = await fetch(url, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({})
          });

          if (res.status === 401 || res.status === 302) {
            window.location.href = "{{ route('login.index') }}";
            console.groupEnd();
            return;
          }

          // Attempt to parse JSON; if parsing fails, log raw text
          let data;
          try {
            data = await res.json();
          } catch (jsonErr) {
            console.error('Failed to parse JSON. Attempting to read raw text for debugging.', jsonErr);
            try {
              const raw = await res.clone().text();
              console.log('Raw response text:', raw);
            } catch (textErr) {
              console.error('Also failed to read raw text:', textErr);
            }
            throw jsonErr; // rethrow to be caught by outer catch
          }

          if (data && data.success) {
            const countEl = document.querySelector(`#likes-${postId}`);
            if (countEl) {
              countEl.textContent = data.likes;
            } else {
              console.warn('Count element not found; skipping count update.');
            }

            btn.classList.toggle('text-slate-400', !data.liked);
            btn.classList.toggle('text-red-500', data.liked);
          } else {
            console.warn('API returned success != true. Full response data:', data);
          }
        } catch (e) {
          console.error('Error during like click handler:', e);
        } finally {
          console.groupEnd();
        }
      });
    });
    @endonload
  </script>
@endsection