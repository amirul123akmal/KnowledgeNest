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
                    ['name' => 'Explore', 'mobile_name' => 'Explore Skills', 'url' => "/#filters", "hidden" => false],
                    ['name' => 'About Us', 'mobile_name' => 'About Us', 'url' => "/aboutus", "hidden" => false],
                    ['name' => 'Why Join Us', 'mobile_name' => 'Why Join Us', 'url' => "/joinus", "hidden" => false],
                    ['name' => 'Profile', 'mobile_name' => 'Profile', 'url' => "/user/profile", "hidden" => true],
                ];
            @endphp

            <!-- Desktop Links -->
            <div class="hidden md:flex items-center gap-1 bg-slate-100/50 p-1 rounded-full border border-white/40">
                @foreach ($data as $item)
                    @if ($item['name'] === 'Profile') @continue @endif
                    @if (!$item['hidden'])
                        <a href="{{ $item['url'] }}" class="px-4 py-1.5 rounded-full text-sm font-medium text-slate-600 hover:text-brand-700 hover:bg-white transition-all shadow-sm shadow-transparent hover:shadow-sm {{ request()->fullUrlIs(url($item['url'])) ? 'bg-white' : '' }}">{{ $item['name'] }}</a>
                        @continue
                    @endif
                    @auth
                        <a href="{{ $item['url'] }}" class="px-4 py-1.5 rounded-full text-sm font-medium text-slate-600 hover:text-brand-700 hover:bg-white transition-all shadow-sm shadow-transparent hover:shadow-sm {{ request()->fullUrlIs(url($item['url'])) ? 'bg-white' : '' }}">{{ $item['name'] }}</a>
                    @endauth
                @endforeach
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-3">
                <!-- Search Input Container -->
                <form id="searchForm" action="{{ route('search') }}" method="GET" class="relative flex items-center overflow-hidden transition-all duration-500 cubic-bezier(0.4, 0, 0.2, 1)" style="width: 0; opacity: 0; margin-right: 0;">
                    <input id="searchInput" type="text" name="q" placeholder="Search..." class="w-full pl-5 pr-10 py-2 rounded-full bg-slate-100/80 backdrop-blur-sm border border-transparent focus:border-brand-200 text-sm text-slate-700 focus:outline-none focus:ring-brand-500/10 placeholder:text-slate-400 shadow-inner transition-all" autocomplete="off">
                    <button type="button" id="searchCloseBtn" class="absolute right-3 text-slate-400 hover:text-slate-600 transition-colors p-1 rounded-full hover:bg-slate-200/50">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </form>

                <!-- Search Toggle Button -->
                <button id="searchToggleBtn" class="flex items-center justify-center w-10 h-10 rounded-full bg-slate-100 text-slate-600 hover:bg-white hover:text-brand-600 hover:shadow-md transition-all duration-300 border border-transparent hover:border-slate-100 group">
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
                @guest
                    <a href="{{ route('login.index') }}" class="hidden md:inline-flex items-center gap-2 bg-slate-900 text-white px-5 py-2 rounded-full text-sm font-semibold hover:bg-slate-800 transition shadow-lg shadow-slate-900/20">
                        Join Now
                    </a>
                @endguest
                @auth
                    <!-- User Dropdown -->
                    <div class="relative hidden md:block" id="userDropdownContainer">
                        <button id="userDropdownBtn" class="flex items-center gap-2 pl-2 pr-1 py-1 rounded-full bg-white border border-slate-200 hover:border-brand-300 transition-all shadow-sm group">
                            <span class="text-sm font-semibold text-slate-700 pl-2">{{ Auth::user()->name }}</span>
                            <img src="{{ strpos(Auth::user()->picture, 'https://') === 0 ? Auth::user()->picture : Storage::url(Auth::user()->picture) }}" alt="User" class="w-8 h-8 rounded-full object-cover border border-slate-100 group-hover:scale-105 transition-transform">
                            <svg class="w-4 h-4 text-slate-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="userDropdown" class="absolute right-0 top-full mt-2 w-56 bg-white rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden transform opacity-0 scale-95 pointer-events-none transition-all duration-200 origin-top-right">
                            <div class="p-2 space-y-1">
                                <a href="{{ route('profile.index') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium text-slate-600 rounded-xl hover:bg-slate-50 hover:text-brand-600 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Profile
                                </a>
                                <a href="{{ route('dashboard.index') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium text-slate-600 rounded-xl hover:bg-slate-50 hover:text-brand-600 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                    </svg>
                                    Dashboard
                                </a>
                                <a href="{{ route('posts.saved') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium text-slate-600 rounded-xl hover:bg-slate-50 hover:text-brand-600 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                    </svg>
                                    Saved Posts
                                </a>
                            </div>
                            <div class="h-px bg-slate-100 my-1"></div>
                            <div class="p-2">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 text-sm font-medium text-rose-600 rounded-xl hover:bg-rose-50 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
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
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Mobile Menu Logic
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const closeMenuBtn = document.getElementById('closeMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        if (mobileMenuBtn && mobileMenu && closeMenuBtn) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.remove('translate-x-full');
            });

            closeMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.add('translate-x-full');
            });
        }

        // Dropdown Logic
        const dropdownBtn = document.getElementById('userDropdownBtn');
        const dropdownMenu = document.getElementById('userDropdown');

        if (dropdownBtn && dropdownMenu) {
            dropdownBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                const isHidden = dropdownMenu.classList.contains('opacity-0');
                if (isHidden) {
                    // Show
                    dropdownMenu.classList.remove('opacity-0', 'scale-95', 'pointer-events-none');
                    dropdownMenu.classList.add('opacity-100', 'scale-100', 'pointer-events-auto');
                } else {
                    // Hide
                    dropdownMenu.classList.remove('opacity-100', 'scale-100', 'pointer-events-auto');
                    dropdownMenu.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                }
            });

            // Close on click outside
            document.addEventListener('click', (e) => {
                if (!dropdownBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.remove('opacity-100', 'scale-100', 'pointer-events-auto');
                    dropdownMenu.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                }
            });
        }
        // Search Logic
        const searchForm = document.getElementById('searchForm');
        const searchInput = document.getElementById('searchInput');
        const toggleBtn = document.getElementById('searchToggleBtn');
        const searchCloseBtn = document.getElementById('searchCloseBtn');
        let isSearchOpen = false;

        function openSearch() {
            if (!searchForm) return;
            searchForm.style.width = '18rem';
            searchForm.style.opacity = '1';
            searchForm.style.marginRight = '0.5rem';
            // Wait for transition to start before focusing to avoid layout jumps
            setTimeout(() => searchInput.focus(), 100);
            toggleBtn.classList.add('bg-slate-200', 'text-brand-600', 'scale-90');
            isSearchOpen = true;
        }

        function closeSearch() {
            if (!searchForm) return;
            searchForm.style.width = '0';
            searchForm.style.opacity = '0';
            searchForm.style.marginRight = '0';
            toggleBtn.classList.remove('bg-slate-200', 'text-brand-600', 'scale-90');
            isSearchOpen = false;
        }

        if (toggleBtn && searchForm) {
            toggleBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                if (isSearchOpen) closeSearch(); else openSearch();
            });

            if (searchCloseBtn) {
                searchCloseBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    closeSearch();
                });
            }

            document.addEventListener('click', (e) => {
                if (isSearchOpen && !searchForm.contains(e.target) && !toggleBtn.contains(e.target)) {
                    closeSearch();
                }
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && isSearchOpen) closeSearch();
            });
        }
    });
</script>