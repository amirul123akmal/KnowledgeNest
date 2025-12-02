<!-- Floating Navigation -->
<nav class="fixed top-4 left-0 right-0 z-50 px-4 md:px-0 pointer-events-none">
    <div class="max-w-6xl mx-auto pointer-events-auto">
        <div class="glass rounded-full px-5 py-3 flex items-center justify-between shadow-lg shadow-black/5 ring-1 ring-white/50">

            <!-- Logo -->
            <div class="flex items-center gap-2.5">
                <a href="{{ route('posts.index') }}" class="group">
                    <div class="w-9 h-9 rounded-xl bg-linear-to-br from-brand-500 to-indigo-600 flex items-center justify-center text-white shadow-lg shadow-brand-500/30 group-hover:scale-105 transition-transform duration-300">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2v20M2 12h20" />
                        </svg>
                    </div>
                </a>
                <a href="/" class="flex flex-col">
                    <span class="font-bold text-slate-800 leading-none text-base tracking-tight">Knowledge Nest</span>
                    <span class="text-[10px] uppercase tracking-wider font-semibold text-brand-600 mt-0.5">Community Hub</span>
                </a>
            </div>

            @php
                $data = [
                    ['name' => 'Explore', 'mobile_name' => 'Explore Skills', 'url' => '#filters'],
                    ['name' => 'Mentors', 'mobile_name' => 'Find Mentors', 'url' => '#'],
                    ['name' => 'Events', 'mobile_name' => 'Community Events', 'url' => '#'],
                ]
            @endphp

            <!-- Desktop Links -->
            <div class="hidden md:flex items-center gap-1 bg-slate-100/50 p-1 rounded-full border border-white/40">
                @foreach ($data as $item)
                    <a href="{{ $item['url'] }}" class="px-4 py-1.5 rounded-full text-sm font-medium text-slate-600 hover:text-brand-700 hover:bg-white transition-all shadow-sm shadow-transparent hover:shadow-sm">{{ $item['name'] }}</a>
                @endforeach
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-3">
                <button class="hidden sm:flex items-center justify-center w-9 h-9 rounded-full bg-slate-100 text-slate-600 hover:bg-slate-200 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
                @guest
                    <a href="{{ route('login.index') }}" class="hidden md:inline-flex items-center gap-2 bg-slate-900 text-white px-5 py-2 rounded-full text-sm font-semibold hover:bg-slate-800 transition shadow-lg shadow-slate-900/20">
                        Join Now
                    </a>
                @endguest
                @auth
                    <form action="{{ route('logout') }}" method="POST" class="hidden md:inline-flex">
                        @csrf
                        <button type="submit" class="items-center gap-2 bg-slate-900 text-white px-5 py-2 rounded-full text-sm font-semibold hover:bg-slate-800 transition shadow-lg shadow-slate-900/20">
                            Logout
                        </button>
                    </form>
                @endauth
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
<div id="mobileMenu" class="fixed inset-0 z-40 bg-white/95 backdrop-blur-xl transform translate-x-full transition-transform duration-300 md:hidden flex flex-col pt-24 px-6 gap-6">
    @foreach ($data as $item)
        <a href="{{ $item['url'] }}" class="text-2xl font-bold text-slate-800">{{ $item['mobile_name'] }}</a>
    @endforeach
    <hr class="border-slate-200">
    <a href="{{ route('login.index') }}" class="w-full bg-brand-600 text-white text-center py-4 rounded-xl font-bold text-lg">Sign Up / Login</a>
    <button id="closeMenuBtn" class="absolute top-6 right-6 p-2 bg-slate-100 rounded-full">
        <svg class="w-6 h-6 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>