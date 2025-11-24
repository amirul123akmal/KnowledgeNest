<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Knowledge Nest — Community Skills</title>

  <!-- Google Fonts: Plus Jakarta Sans for a modern, geometric look -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
    rel="stylesheet">

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['"Plus Jakarta Sans"', 'sans-serif'],
          },
          colors: {
            brand: {
              50: '#f5f3ff',
              100: '#ede9fe',
              200: '#ddd6fe',
              300: '#c4b5fd',
              400: '#a78bfa',
              500: '#8b5cf6',
              600: '#7c3aed', // Primary interaction color
              700: '#6d28d9',
              800: '#5b21b6',
              900: '#4c1d95',
            },
            surface: '#ffffff',
          },
          animation: {
            'fade-in': 'fadeIn 0.6s ease-out forwards',
            'slide-up': 'slideUp 0.5s ease-out forwards',
            'float': 'float 6s ease-in-out infinite',
          },
          keyframes: {
            fadeIn: {
              '0%': { opacity: '0' },
              '100%': { opacity: '1' },
            },
            slideUp: {
              '0%': { opacity: '0', transform: 'translateY(20px)' },
              '100%': { opacity: '1', transform: 'translateY(0)' },
            },
            float: {
              '0%, 100%': { transform: 'translateY(0)' },
              '50%': { transform: 'translateY(-10px)' },
            }
          },
          boxShadow: {
            'glow': '0 0 20px rgba(124, 58, 237, 0.3)',
            'card': '0 10px 40px -10px rgba(0,0,0,0.08)',
            'card-hover': '0 20px 40px -10px rgba(124, 58, 237, 0.15)',
          }
        }
      }
    }
  </script>

  <style>
    /* Custom Scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
    }

    ::-webkit-scrollbar-track {
      background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
      background: #c4b5fd;
      border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: #a78bfa;
    }

    /* Glassmorphism Utilities */
    .glass {
      background: rgba(255, 255, 255, 0.7);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.5);
    }

    .glass-dark {
      background: rgba(17, 24, 39, 0.7);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* Hide scrollbar for horizontal scrolling areas but keep functionality */
    .no-scrollbar::-webkit-scrollbar {
      display: none;
    }

    .no-scrollbar {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }

    /* Smooth Image Transitions */
    .img-zoom-container {
      overflow: hidden;
    }

    .img-zoom {
      transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .group:hover .img-zoom {
      transform: scale(1.1);
    }
  </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased selection:bg-brand-200 selection:text-brand-900">

  <!-- Floating Navigation -->
  <nav class="fixed top-4 left-0 right-0 z-50 px-4 md:px-0 pointer-events-none">
    <div class="max-w-6xl mx-auto pointer-events-auto">
      <div
        class="glass rounded-full px-5 py-3 flex items-center justify-between shadow-lg shadow-black/5 ring-1 ring-white/50">

        <!-- Logo -->
        <a href="#" class="flex items-center gap-2.5 group">
          <div
            class="w-9 h-9 rounded-xl bg-gradient-to-br from-brand-500 to-indigo-600 flex items-center justify-center text-white shadow-lg shadow-brand-500/30 group-hover:scale-105 transition-transform duration-300">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
              stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 2v20M2 12h20" />
            </svg>
          </div>
          <div class="flex flex-col">
            <span class="font-bold text-slate-800 leading-none text-base tracking-tight">Knowledge Nest</span>
            <span class="text-[10px] uppercase tracking-wider font-semibold text-brand-600 mt-0.5">Community Hub</span>
          </div>
        </a>

        <!-- Desktop Links -->
        <div class="hidden md:flex items-center gap-1 bg-slate-100/50 p-1 rounded-full border border-white/40">
          <a href="#"
            class="px-4 py-1.5 rounded-full text-sm font-medium text-slate-600 hover:text-brand-700 hover:bg-white transition-all shadow-sm shadow-transparent hover:shadow-sm">Explore</a>
          <a href="#"
            class="px-4 py-1.5 rounded-full text-sm font-medium text-slate-600 hover:text-brand-700 hover:bg-white transition-all shadow-sm shadow-transparent hover:shadow-sm">Mentors</a>
          <a href="#"
            class="px-4 py-1.5 rounded-full text-sm font-medium text-slate-600 hover:text-brand-700 hover:bg-white transition-all shadow-sm shadow-transparent hover:shadow-sm">Events</a>
        </div>

        <!-- Actions -->
        <div class="flex items-center gap-3">
          <button
            class="hidden sm:flex items-center justify-center w-9 h-9 rounded-full bg-slate-100 text-slate-600 hover:bg-slate-200 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </button>
          <a href="#"
            class="hidden md:inline-flex items-center gap-2 bg-slate-900 text-white px-5 py-2 rounded-full text-sm font-semibold hover:bg-slate-800 transition shadow-lg shadow-slate-900/20">
            Join Now
          </a>
          <!-- Mobile Menu Button -->
          <button id="mobileMenuBtn" class="md:hidden p-2 text-slate-600 hover:text-brand-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </nav>

  <!-- Mobile Menu Dropdown (Hidden by default) -->
  <div id="mobileMenu"
    class="fixed inset-0 z-40 bg-white/95 backdrop-blur-xl transform translate-x-full transition-transform duration-300 md:hidden flex flex-col pt-24 px-6 gap-6">
    <a href="#" class="text-2xl font-bold text-slate-800">Explore Skills</a>
    <a href="#" class="text-2xl font-bold text-slate-800">Find Mentors</a>
    <a href="#" class="text-2xl font-bold text-slate-800">Community Events</a>
    <hr class="border-slate-200">
    <a href="#" class="w-full bg-brand-600 text-white text-center py-4 rounded-xl font-bold text-lg">Sign Up / Login</a>
    <button id="closeMenuBtn" class="absolute top-6 right-6 p-2 bg-slate-100 rounded-full">
      <svg class="w-6 h-6 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
  </div>

  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-12">

    <!-- Hero Section: Bento Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-16 animate-fade-in">

      <!-- Main Hero Card -->
      <div
        class="lg:col-span-8 bg-brand-900 rounded-[2rem] p-8 md:p-12 relative overflow-hidden group min-h-[400px] flex flex-col justify-center">
        <!-- Abstract Background -->
        <div
          class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-brand-500/30 rounded-full blur-3xl group-hover:bg-brand-500/40 transition-colors duration-700">
        </div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-indigo-600/30 rounded-full blur-3xl"></div>

        <div class="relative z-10 max-w-lg">
          <div
            class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-brand-100 text-xs font-semibold backdrop-blur-md mb-6 border border-white/10">
            <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
            Live in your area
          </div>
          <h1 class="text-4xl md:text-6xl font-extrabold text-white tracking-tight leading-[1.1] mb-6">
            Share skills.<br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-300 to-indigo-300">Shop local.</span>
          </h1>
          <p class="text-brand-100 text-lg mb-8 leading-relaxed">
            The neighborhood marketplace for trading talents, discovering hobbies, and supporting local side-hustles.
          </p>
          <div class="flex flex-wrap gap-4">
            <button
              class="bg-white text-brand-900 px-8 py-3.5 rounded-full font-bold hover:bg-brand-50 transition shadow-xl shadow-brand-900/20 flex items-center gap-2 group-hover:scale-105 duration-200">
              Start Exploring
              <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
              </svg>
            </button>
            <button
              class="px-8 py-3.5 rounded-full font-bold text-white border border-white/20 hover:bg-white/10 transition backdrop-blur-sm">
              List a Service
            </button>
          </div>
        </div>

        <!-- Decorative Floating Image -->
        <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=600&auto=format&fit=crop"
          class="absolute -right-12 bottom-12 w-64 h-64 object-cover rounded-2xl shadow-2xl rotate-[-6deg] border-4 border-white/10 hidden md:block animate-float"
          alt="User teaching">
      </div>

      <!-- Right Column: Stats & Trending -->
      <div class="lg:col-span-4 flex flex-col gap-6">

        <!-- Trending Card -->
        <div
          class="bg-white rounded-[2rem] p-6 border border-slate-100 shadow-card flex-1 relative overflow-hidden group">
          <div class="flex justify-between items-center mb-4">
            <h3 class="font-bold text-lg text-slate-800">Trending Now</h3>
            <span class="text-2xl">🔥</span>
          </div>
          <div class="space-y-4 relative z-10">
            <div
              class="flex items-center gap-4 p-3 rounded-xl bg-slate-50 hover:bg-brand-50 transition cursor-pointer group/item">
              <span class="text-2xl group-hover/item:scale-110 transition">🎸</span>
              <div>
                <div class="font-bold text-slate-700">Guitar Lessons</div>
                <div class="text-xs text-slate-500">12 new listings</div>
              </div>
            </div>
            <div
              class="flex items-center gap-4 p-3 rounded-xl bg-slate-50 hover:bg-brand-50 transition cursor-pointer group/item">
              <span class="text-2xl group-hover/item:scale-110 transition">🍞</span>
              <div>
                <div class="font-bold text-slate-700">Sourdough Starter</div>
                <div class="text-xs text-slate-500">High demand</div>
              </div>
            </div>
            <div
              class="flex items-center gap-4 p-3 rounded-xl bg-slate-50 hover:bg-brand-50 transition cursor-pointer group/item">
              <span class="text-2xl group-hover/item:scale-110 transition">🌱</span>
              <div>
                <div class="font-bold text-slate-700">Plant Sitting</div>
                <div class="text-xs text-slate-500">Summer spikes</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Community Stat Card -->
        <div
          class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-[2rem] p-6 text-white shadow-lg shadow-indigo-500/20 relative overflow-hidden">
          <svg class="absolute top-0 right-0 text-white/10 w-32 h-32 -mr-8 -mt-8" fill="currentColor"
            viewBox="0 0 24 24">
            <path d="M12 2a10 10 0 1010 10A10 10 0 0012 2zm0 18a8 8 0 118-8 8 8 0 01-8 8z" />
          </svg>
          <div class="relative z-10">
            <div class="text-indigo-100 font-medium mb-1">Active Neighbors</div>
            <div class="text-4xl font-extrabold mb-4">2,408</div>
            <div class="flex -space-x-3">
              <img class="w-10 h-10 rounded-full border-2 border-indigo-500"
                src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop" alt="">
              <img class="w-10 h-10 rounded-full border-2 border-indigo-500"
                src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=100&h=100&fit=crop" alt="">
              <img class="w-10 h-10 rounded-full border-2 border-indigo-500"
                src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop" alt="">
              <div
                class="w-10 h-10 rounded-full border-2 border-indigo-500 bg-white text-indigo-600 flex items-center justify-center text-xs font-bold">
                +2k</div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- Filters / Sticky Header -->
    <div class="sticky top-24 z-30 mb-8">
      <div
        class="bg-white/80 backdrop-blur-md rounded-2xl p-2 shadow-sm border border-slate-200/60 flex items-center justify-between overflow-x-auto no-scrollbar">
        <div class="flex items-center gap-1 p-1">
          <button
            class="px-4 py-2 rounded-xl bg-slate-900 text-white text-sm font-semibold shadow-md whitespace-nowrap">All
            Listings</button>
          <button
            class="px-4 py-2 rounded-xl text-slate-600 hover:bg-slate-100 text-sm font-medium transition whitespace-nowrap">Workshop</button>
          <button
            class="px-4 py-2 rounded-xl text-slate-600 hover:bg-slate-100 text-sm font-medium transition whitespace-nowrap">Home
            Services</button>
          <button
            class="px-4 py-2 rounded-xl text-slate-600 hover:bg-slate-100 text-sm font-medium transition whitespace-nowrap">Food
            & Garden</button>
          <button
            class="px-4 py-2 rounded-xl text-slate-600 hover:bg-slate-100 text-sm font-medium transition whitespace-nowrap">Tech
            Support</button>
        </div>
        <div class="hidden md:flex items-center border-l pl-4 ml-2 border-slate-200">
          <button class="text-sm font-medium text-slate-500 hover:text-brand-600 flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
            </svg>
            Filters
          </button>
        </div>
      </div>
    </div>

    <!-- Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 animate-slide-up">

      <!-- Card 1 -->
      <article
        class="group bg-white rounded-3xl p-3 border border-slate-100 shadow-card hover:shadow-card-hover transition-all duration-300 hover:-translate-y-1">
        <div class="relative h-48 rounded-2xl overflow-hidden mb-3 img-zoom-container">
          <img src="https://images.unsplash.com/photo-1513828742140-ccaa28f3eda0?q=80&w=800&auto=format&fit=crop"
            alt="Pottery" class="w-full h-full object-cover img-zoom">
          <div class="absolute top-3 right-3">
            <button
              class="bg-white/90 backdrop-blur-sm p-2 rounded-full shadow-sm hover:scale-110 transition active:scale-95 text-slate-400 hover:text-red-500">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
              </svg>
            </button>
          </div>
          <div
            class="absolute bottom-3 left-3 bg-black/60 backdrop-blur-md px-2.5 py-1 rounded-lg border border-white/10 text-xs font-semibold text-white flex items-center gap-1">
            <span class="w-1.5 h-1.5 bg-green-400 rounded-full"></span> $25 / hr
          </div>
        </div>

        <div class="px-1 pb-2">
          <div class="flex items-center gap-2 mb-2">
            <div class="bg-blue-50 text-blue-600 px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider">
              Class</div>
            <div class="text-xs text-slate-400 font-medium">1.2 miles away</div>
          </div>
          <h3 class="font-bold text-slate-800 text-lg leading-snug mb-1 group-hover:text-brand-600 transition-colors">
            Weekend Clay Pottery Workshop</h3>
          <p class="text-slate-500 text-sm line-clamp-2 mb-4">Learn to throw on the wheel with a local artist. All
            materials provided.</p>

          <div class="flex items-center justify-between border-t border-slate-100 pt-3">
            <div class="flex items-center gap-2">
              <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop"
                class="w-8 h-8 rounded-full object-cover ring-2 ring-white" alt="Avatar">
              <span class="text-xs font-semibold text-slate-700">Sarah J.</span>
            </div>
            <div class="flex items-center gap-1 text-amber-500 text-xs font-bold">
              <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
              </svg>
              4.9 (82)
            </div>
          </div>
        </div>
      </article>

      <!-- Card 2 -->
      <article
        class="group bg-white rounded-3xl p-3 border border-slate-100 shadow-card hover:shadow-card-hover transition-all duration-300 hover:-translate-y-1">
        <div class="relative h-48 rounded-2xl overflow-hidden mb-3 img-zoom-container">
          <img src="https://images.unsplash.com/photo-1581291518633-83b4ebd1d83e?q=80&w=800&auto=format&fit=crop"
            alt="Tutoring" class="w-full h-full object-cover img-zoom">
          <div class="absolute top-3 right-3">
            <button
              class="bg-white/90 backdrop-blur-sm p-2 rounded-full shadow-sm hover:scale-110 transition active:scale-95 text-slate-400 hover:text-red-500">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
              </svg>
            </button>
          </div>
          <div
            class="absolute bottom-3 left-3 bg-black/60 backdrop-blur-md px-2.5 py-1 rounded-lg border border-white/10 text-xs font-semibold text-white flex items-center gap-1">
            Free
          </div>
        </div>

        <div class="px-1 pb-2">
          <div class="flex items-center gap-2 mb-2">
            <div
              class="bg-purple-50 text-purple-600 px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider">
              Education</div>
            <div class="text-xs text-slate-400 font-medium">0.5 miles away</div>
          </div>
          <h3 class="font-bold text-slate-800 text-lg leading-snug mb-1 group-hover:text-brand-600 transition-colors">
            Math Tutoring for Kids</h3>
          <p class="text-slate-500 text-sm line-clamp-2 mb-4">Retired math teacher offering free tutoring on Tuesday
            afternoons.</p>

          <div class="flex items-center justify-between border-t border-slate-100 pt-3">
            <div class="flex items-center gap-2">
              <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop"
                class="w-8 h-8 rounded-full object-cover ring-2 ring-white" alt="Avatar">
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
      <article
        class="group bg-white rounded-3xl p-3 border border-slate-100 shadow-card hover:shadow-card-hover transition-all duration-300 hover:-translate-y-1">
        <div class="relative h-48 rounded-2xl overflow-hidden mb-3 img-zoom-container">
          <img src="https://images.unsplash.com/photo-1592417817098-8fd3d9eb14a5?q=80&w=800&auto=format&fit=crop"
            alt="Baking" class="w-full h-full object-cover img-zoom">
          <div class="absolute top-3 right-3">
            <button
              class="bg-white/90 backdrop-blur-sm p-2 rounded-full shadow-sm hover:scale-110 transition active:scale-95 text-slate-400 hover:text-red-500">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
              </svg>
            </button>
          </div>
          <div
            class="absolute bottom-3 left-3 bg-black/60 backdrop-blur-md px-2.5 py-1 rounded-lg border border-white/10 text-xs font-semibold text-white flex items-center gap-1">
            <span class="w-1.5 h-1.5 bg-green-400 rounded-full"></span> Barter
          </div>
        </div>

        <div class="px-1 pb-2">
          <div class="flex items-center gap-2 mb-2">
            <div
              class="bg-orange-50 text-orange-600 px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider">
              Food</div>
            <div class="text-xs text-slate-400 font-medium">0.8 miles away</div>
          </div>
          <h3 class="font-bold text-slate-800 text-lg leading-snug mb-1 group-hover:text-brand-600 transition-colors">
            Fresh Cinnamon Rolls</h3>
          <p class="text-slate-500 text-sm line-clamp-2 mb-4">Baked fresh this morning! Willing to trade for fresh eggs
            or honey.</p>

          <div class="flex items-center justify-between border-t border-slate-100 pt-3">
            <div class="flex items-center gap-2">
              <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=100&h=100&fit=crop"
                class="w-8 h-8 rounded-full object-cover ring-2 ring-white" alt="Avatar">
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
      <article
        class="group bg-white rounded-3xl p-3 border border-slate-100 shadow-card hover:shadow-card-hover transition-all duration-300 hover:-translate-y-1">
        <div class="relative h-48 rounded-2xl overflow-hidden mb-3 img-zoom-container">
          <img src="https://images.unsplash.com/photo-1588611910609-0d12759e09d1?q=80&w=800&auto=format&fit=crop"
            alt="Repair" class="w-full h-full object-cover img-zoom">
          <div class="absolute top-3 right-3">
            <button
              class="bg-white/90 backdrop-blur-sm p-2 rounded-full shadow-sm hover:scale-110 transition active:scale-95 text-slate-400 hover:text-red-500">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
              </svg>
            </button>
          </div>
          <div
            class="absolute bottom-3 left-3 bg-black/60 backdrop-blur-md px-2.5 py-1 rounded-lg border border-white/10 text-xs font-semibold text-white flex items-center gap-1">
            <span class="w-1.5 h-1.5 bg-green-400 rounded-full"></span> Quote
          </div>
        </div>

        <div class="px-1 pb-2">
          <div class="flex items-center gap-2 mb-2">
            <div class="bg-cyan-50 text-cyan-600 px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider">
              Service</div>
            <div class="text-xs text-slate-400 font-medium">2.1 miles away</div>
          </div>
          <h3 class="font-bold text-slate-800 text-lg leading-snug mb-1 group-hover:text-brand-600 transition-colors">PC
            Repair & Diagnostics</h3>
          <p class="text-slate-500 text-sm line-clamp-2 mb-4">Slow computer? I can fix software issues, replace SSDs,
            and clean viruses.</p>

          <div class="flex items-center justify-between border-t border-slate-100 pt-3">
            <div class="flex items-center gap-2">
              <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&h=100&fit=crop"
                class="w-8 h-8 rounded-full object-cover ring-2 ring-white" alt="Avatar">
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
      <div
        class="bg-slate-50 rounded-3xl p-6 border-2 border-dashed border-slate-200 flex flex-col items-center justify-center text-center hover:border-brand-300 hover:bg-brand-50/50 transition duration-300 cursor-pointer group">
        <div
          class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center text-brand-500 mb-4 group-hover:scale-110 transition duration-300 group-hover:text-brand-600">
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

  <!-- Modern Footer -->
  <footer class="border-t border-slate-200 bg-white pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-12">
        <div class="col-span-2 md:col-span-1">
          <div class="flex items-center gap-2 mb-4">
            <div class="w-8 h-8 rounded-lg bg-brand-600 flex items-center justify-center text-white">
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M12 2v20M2 12h20" />
              </svg>
            </div>
            <span class="font-bold text-lg">Knowledge Nest</span>
          </div>
          <p class="text-slate-500 text-sm leading-relaxed">
            Building stronger communities through skill-sharing and local commerce.
          </p>
        </div>

        <div>
          <h4 class="font-bold text-slate-800 mb-4">Platform</h4>
          <ul class="space-y-2 text-sm text-slate-500">
            <li><a href="#" class="hover:text-brand-600">Browse Categories</a></li>
            <li><a href="#" class="hover:text-brand-600">How it Works</a></li>
            <li><a href="#" class="hover:text-brand-600">Pricing</a></li>
            <li><a href="#" class="hover:text-brand-600">Trust & Safety</a></li>
          </ul>
        </div>

        <div>
          <h4 class="font-bold text-slate-800 mb-4">Resources</h4>
          <ul class="space-y-2 text-sm text-slate-500">
            <li><a href="#" class="hover:text-brand-600">Community Blog</a></li>
            <li><a href="#" class="hover:text-brand-600">Help Center</a></li>
            <li><a href="#" class="hover:text-brand-600">Guidelines</a></li>
          </ul>
        </div>

        <div>
          <h4 class="font-bold text-slate-800 mb-4">Stay in the loop</h4>
          <div class="flex flex-col gap-2">
            <input type="email" placeholder="Enter your email"
              class="bg-slate-50 border border-slate-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500">
            <button
              class="bg-slate-900 text-white rounded-lg px-4 py-2 text-sm font-semibold hover:bg-slate-800 transition">Subscribe</button>
          </div>
        </div>
      </div>

      <div class="border-t border-slate-100 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="text-sm text-slate-400">© 2024 Knowledge Nest Inc.</div>
        <div class="flex gap-6 text-slate-400">
          <a href="#" class="hover:text-slate-600"><span class="sr-only">Twitter</span><svg class="w-5 h-5"
              fill="currentColor" viewBox="0 0 24 24">
              <path
                d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
            </svg></a>
          <a href="#" class="hover:text-slate-600"><span class="sr-only">Instagram</span><svg class="w-5 h-5"
              fill="currentColor" viewBox="0 0 24 24">
              <path fill-rule="evenodd"
                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.468 2.373c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                clip-rule="evenodd" />
            </svg></a>
        </div>
      </div>
    </div>
  </footer>

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
  </script>
</body>

</html>