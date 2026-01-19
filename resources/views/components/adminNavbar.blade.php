<!-- Topbar (mobile + desktop) -->
<!-- Topbar (mobile + desktop) -->
<header class="flex items-center justify-between px-4 py-3 md:px-6 sticky top-0 z-30 glass transition-all duration-300">
    <div class="flex items-center gap-3">
        <button @click="mobileOpen = true" class="md:hidden inline-flex items-center gap-2 px-2 py-2 rounded-xl bg-slate-50 text-slate-700 hover:bg-brand-50 hover:text-brand-600 transition-colors">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <div class="hidden md:flex items-center gap-3">
            <h2 class="text-xl font-bold bg-clip-text text-transparent bg-linear-to-r from-brand-600 to-indigo-600">Dashboard</h2>
            <span class="px-2.5 py-1 rounded-full bg-brand-50 text-brand-700 text-xs font-semibold border border-brand-100">Manager</span>
        </div>
    </div>

    <div class="flex items-center gap-4">
        <a href="" class="px-4 py-2 text-sm rounded-full bg-white border border-slate-200 shadow-sm hidden md:inline-flex items-center gap-2 hover:border-brand-300 hover:text-brand-600 transition-all active:scale-95 group">
            <svg class="w-4 h-4 text-slate-400 group-hover:text-brand-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
            Quick actions
        </a>

        <div x-data="{ open: false }" @click.outside="open = false" class="relative">
            <button @click="open = !open" class="h-10 w-10 rounded-full bg-brand-100 border-2 border-white shadow-md flex items-center justify-center text-brand-700 font-bold cursor-pointer hover:scale-105 transition-transform">
                {{ auth()->user()->initials ?? 'A' }}
            </button>

            <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 z-10 mt-2 w-56 rounded-2xl bg-white py-2 shadow-xl ring-1 ring-black/5 focus:outline-none border border-slate-100" role="menu" tabindex="-1">
                <div class="px-4 py-3 border-b border-slate-50 mb-1">
                    <p class="text-sm font-semibold text-slate-900">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-xs text-slate-500 truncate">{{ auth()->user()->email }}</p>
                </div>
                <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Profile
                </a>
                <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Settings
                </a>
                <div class="border-t border-slate-50 my-1"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2 text-left text-sm text-red-600 hover:bg-red-50 transition-colors flex items-center gap-2 rounded-b-xl">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

<!-- Mobile drawer overlay -->
<div x-show="mobileOpen" x-cloak class="fixed inset-0 z-40 md:hidden">
    <div @click="mobileOpen = false" class="absolute inset-0 bg-black/40"></div>
    <aside class="absolute left-0 top-0 bottom-0 w-72 bg-white border-r border-slate-100">
        <div class="px-6 py-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-lg bg-nest-500 flex items-center justify-center text-white font-bold">KN</div>
                <div>
                    <h1 class="text-lg font-semibold">Knowledge Nest</h1>
                    <p class="text-xs text-slate-500">Admin</p>
                </div>
            </div>
            <button @click="mobileOpen = false" class="text-slate-500">✕</button>
        </div>

        <nav class="px-4 py-2">
            <ul class="space-y-1">
                <li><a href="" class="block px-3 py-2 rounded-md bg-nest-100 text-nest-700">Overview</a></li>
                <li><a href="" class="block px-3 py-2 rounded-md hover:bg-slate-50">Posts</a></li>
                <li><a href="" class="block px-3 py-2 rounded-md hover:bg-slate-50">Shops</a></li>
                <li><a href="" class="block px-3 py-2 rounded-md hover:bg-slate-50">Users</a></li>
                <li><a href="" class="block px-3 py-2 rounded-md hover:bg-slate-50">Settings</a></li>
            </ul>
        </nav>
    </aside>
</div>