<!-- Topbar (mobile + desktop) -->
<header class="flex items-center justify-between bg-white border-b border-slate-100 px-4 py-3 md:px-6">
    <div class="flex items-center gap-3">
        <button @click="mobileOpen = true" class="md:hidden inline-flex items-center gap-2 px-2 py-2 rounded-md bg-nest-50 text-nest-700">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <div class="hidden md:flex items-center gap-4">
            <h2 class="text-lg font-semibold">Dashboard</h2>
            <span class="px-2 py-1 rounded-lg bg-nest-100 text-nest-700 text-xs">Manager</span>
        </div>
    </div>

    <div class="flex items-center gap-3">
        <a href="" class="px-3 py-2 text-sm rounded-md bg-white border border-slate-100 hidden md:inline-flex items-center gap-2">Quick actions</a>

        <div x-data="{ open: false }" @click.outside="open = false" class="relative">
            <button @click="open = !open" class="h-8 w-8 rounded-full bg-nest-300 flex items-center justify-center text-white font-semibold cursor-pointer">
                {{ auth()->user()->initials ?? 'A' }}
            </button>

            <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 z-10 mt-2 w-48 rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">
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