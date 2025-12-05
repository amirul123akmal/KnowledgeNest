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
            <div class="flex items-center gap-4 p-3 rounded-xl bg-slate-50 hover:bg-brand-50 transition cursor-pointer group/item">
              <span class="text-2xl group-hover/item:scale-110 transition">🎸</span>
              <div>
                <div class="font-bold text-slate-700">Guitar Lessons</div>
                <div class="text-xs text-slate-500">12 new listings</div>
              </div>
            </div>
            <div class="flex items-center gap-4 p-3 rounded-xl bg-slate-50 hover:bg-brand-50 transition cursor-pointer group/item">
              <span class="text-2xl group-hover/item:scale-110 transition">🍞</span>
              <div>
                <div class="font-bold text-slate-700">Sourdough Starter</div>
                <div class="text-xs text-slate-500">High demand</div>
              </div>
            </div>
            <div class="flex items-center gap-4 p-3 rounded-xl bg-slate-50 hover:bg-brand-50 transition cursor-pointer group/item">
              <span class="text-2xl group-hover/item:scale-110 transition">🌱</span>
              <div>
                <div class="font-bold text-slate-700">Plant Sitting</div>
                <div class="text-xs text-slate-500">Summer spikes</div>
              </div>
            </div>
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
    <div class="sticky top-24 z-30 mb-8">
      <div class="bg-white/80 backdrop-blur-md rounded-2xl p-2 shadow-sm border border-slate-200/60 flex items-center justify-between overflow-x-auto no-scrollbar">
        <div class="flex items-center gap-1 p-1">
          <button class="px-4 py-2 rounded-xl bg-slate-900 text-white text-sm font-semibold shadow-md whitespace-nowrap">All Listings</button>
          <button class="px-4 py-2 rounded-xl text-slate-600 hover:bg-slate-100 text-sm font-medium transition whitespace-nowrap">Workshop</button>
          <button class="px-4 py-2 rounded-xl text-slate-600 hover:bg-slate-100 text-sm font-medium transition whitespace-nowrap">Home Services</button>
          <button class="px-4 py-2 rounded-xl text-slate-600 hover:bg-slate-100 text-sm font-medium transition whitespace-nowrap">Food & Garden</button>
          <button class="px-4 py-2 rounded-xl text-slate-600 hover:bg-slate-100 text-sm font-medium transition whitespace-nowrap">Tech Support</button>
        </div>
        <div class="hidden md:flex items-center border-l pl-4 ml-2 border-slate-200">
          <button class="text-sm font-medium text-slate-500 hover:text-brand-600 flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
            </svg>
            Filters
          </button>
        </div>
      </div>
    </div>

    <!-- Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 animate-slide-up">

      <!-- Card 1 -->
      @foreach ($posts as $post)
        <x-card :post="$post" />
      @endforeach

      <!-- Card 2 -->
      <article class="group bg-white rounded-3xl p-3 border border-slate-100 shadow-card hover:shadow-card-hover transition-all duration-300 hover:-translate-y-1">
        <div class="relative h-48 rounded-2xl overflow-hidden mb-3 img-zoom-container">
          <img src="https://images.unsplash.com/photo-1581291518633-83b4ebd1d83e?q=80&w=800&auto=format&fit=crop" alt="Tutoring" class="w-full h-full object-cover img-zoom">
          <div class="absolute top-3 right-3">
            <button class="bg-white/90 backdrop-blur-sm p-2 rounded-full shadow-sm hover:scale-110 transition active:scale-95 text-slate-400 hover:text-red-500">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
              </svg>
            </button>
          </div>
        </div>

        <div class="px-1 pb-2">
          <div class="flex items-center gap-2 mb-2">
            <div class="bg-purple-50 text-purple-600 px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider">
              Education</div>
          </div>
          <h3 class="font-bold text-slate-800 text-lg leading-snug mb-1 group-hover:text-brand-600 transition-colors">
            Math Tutoring for Kids</h3>
          <p class="text-slate-500 text-sm line-clamp-2 mb-4">Retired math teacher offering free tutoring on Tuesday
            afternoons.</p>

          <div class="flex items-center justify-between border-t border-slate-100 pt-3">
            <div class="flex items-center gap-2">
              <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop" class="w-8 h-8 rounded-full object-cover ring-2 ring-white" alt="Avatar">
              <span class="text-xs font-semibold text-slate-700">Mr. Roberts</span>
            </div>
            <div class="flex items-center gap-1 text-amber-500 text-xs font-bold">
              <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
              </svg>
              5.0 (12)
            </div>
          </div>
        </div>
      </article>

      <!-- Card 3 -->
      <article class="group bg-white rounded-3xl p-3 border border-slate-100 shadow-card hover:shadow-card-hover transition-all duration-300 hover:-translate-y-1">
        <div class="relative h-48 rounded-2xl overflow-hidden mb-3 img-zoom-container">
          <img src="https://images.unsplash.com/photo-1592417817098-8fd3d9eb14a5?q=80&w=800&auto=format&fit=crop" alt="Baking" class="w-full h-full object-cover img-zoom">
          <div class="absolute top-3 right-3">
            <button class="bg-white/90 backdrop-blur-sm p-2 rounded-full shadow-sm hover:scale-110 transition active:scale-95 text-slate-400 hover:text-red-500">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
              </svg>
            </button>
          </div>
        </div>

        <div class="px-1 pb-2">
          <div class="flex items-center gap-2 mb-2">
            <div class="bg-orange-50 text-orange-600 px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider">
              Food</div>
          </div>
          <h3 class="font-bold text-slate-800 text-lg leading-snug mb-1 group-hover:text-brand-600 transition-colors">
            Fresh Cinnamon Rolls</h3>
          <p class="text-slate-500 text-sm line-clamp-2 mb-4">Baked fresh this morning! Willing to trade for fresh eggs
            or honey.</p>

          <div class="flex items-center justify-between border-t border-slate-100 pt-3">
            <div class="flex items-center gap-2">
              <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=100&h=100&fit=crop" class="w-8 h-8 rounded-full object-cover ring-2 ring-white" alt="Avatar">
              <span class="text-xs font-semibold text-slate-700">Emily R.</span>
            </div>
            <div class="flex items-center gap-1 text-amber-500 text-xs font-bold">
              <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
              </svg>
              4.8 (104)
            </div>
          </div>
        </div>
      </article>

      <!-- Card 4 -->
      <article class="group bg-white rounded-3xl p-3 border border-slate-100 shadow-card hover:shadow-card-hover transition-all duration-300 hover:-translate-y-1">
        <div class="relative h-48 rounded-2xl overflow-hidden mb-3 img-zoom-container">
          <img src="https://images.unsplash.com/photo-1588611910609-0d12759e09d1?q=80&w=800&auto=format&fit=crop" alt="Repair" class="w-full h-full object-cover img-zoom">
          <div class="absolute top-3 right-3">
            <button class="bg-white/90 backdrop-blur-sm p-2 rounded-full shadow-sm hover:scale-110 transition active:scale-95 text-slate-400 hover:text-red-500">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
              </svg>
            </button>
          </div>
        </div>

        <div class="px-1 pb-2">
          <div class="flex items-center gap-2 mb-2">
            <div class="bg-cyan-50 text-cyan-600 px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider">
              Service</div>
          </div>
          <h3 class="font-bold text-slate-800 text-lg leading-snug mb-1 group-hover:text-brand-600 transition-colors">PC
            Repair & Diagnostics</h3>
          <p class="text-slate-500 text-sm line-clamp-2 mb-4">Slow computer? I can fix software issues, replace SSDs,
            and clean viruses.</p>

          <div class="flex items-center justify-between border-t border-slate-100 pt-3">
            <div class="flex items-center gap-2">
              <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&h=100&fit=crop" class="w-8 h-8 rounded-full object-cover ring-2 ring-white" alt="Avatar">
              <span class="text-xs font-semibold text-slate-700">David K.</span>
            </div>
            <div class="flex items-center gap-1 text-amber-500 text-xs font-bold">
              <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
              </svg>
              5.0 (204)
            </div>
          </div>
        </div>
      </article>

      <!-- CTA Card -->
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

    </div>
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

    mobileMenuBtn.addEventListener('click', toggleMenu);
    closeMenuBtn.addEventListener('click', toggleMenu);

    // Login Success Alert
    @if (session('success'))
      @onload
      Swal.fire({
        icon: 'success',
        title: 'Welcome Back!',
        text: "{{ session('success') }}",
        timer: 3000,
        showConfirmButton: false,
      });
      @endonload
    @endif
  </script>
@endsection