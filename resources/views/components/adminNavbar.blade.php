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

        <div class="flex items-center gap-2">
            <button class="h-8 w-8 rounded-full bg-nest-300 flex items-center justify-center text-white font-semibold">
                {{ auth()->user()->initials ?? 'A' }}
            </button>
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