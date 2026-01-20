<aside class="bg-white border-r border-slate-100 w-72 shrink-0 hidden md:flex flex-col z-20">
    <div class="px-6 py-8">
        <div class="flex items-center gap-3.5">
            <div class="h-12 w-12 rounded-2xl bg-linear-to-br from-brand-400 to-brand-600 flex items-center justify-center text-white font-bold shadow-lg shadow-brand-500/30 text-xl">KN</div>
            <div>
                <h1 class="text-xl font-bold text-slate-900 tracking-tight">Knowledge Nest</h1>
                <p class="text-xs font-semibold text-brand-600 px-2 py-0.5 bg-brand-50 rounded-md inline-block mt-1">ADMIN</p>
            </div>
        </div>
    </div>

    <nav class="px-4 py-2 flex-1 space-y-8">
        <div>
            <div class="px-4 mb-2 text-xs font-bold text-slate-400 uppercase tracking-wider">Main Menu</div>
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('admin.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('admin.index') ? 'bg-brand-50 text-brand-700 shadow-sm ring-1 ring-brand-100' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} group">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.index') ? 'text-brand-600' : 'text-slate-400 group-hover:text-slate-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        <span class="font-medium">Overview</span>
                    </a>
                </li>
                <li><a href="{{ route('admin.posts.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('admin.posts.index') ? 'bg-brand-50 text-brand-700 shadow-sm ring-1 ring-brand-100' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} group">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.posts.index') ? 'text-brand-600' : 'text-slate-400 group-hover:text-slate-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                        Posts
                    </a></li>
                <li><a href="#" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-all group">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Shops
                    </a></li>
                <li><a href="{{ route('users.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all {{ request()->routeIs('users.index') ? 'bg-brand-50 text-brand-700 shadow-sm ring-1 ring-brand-100' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} group">
                        <svg class="w-5 h-5 {{ request()->routeIs('users.index') ? 'text-brand-600' : 'text-slate-400 group-hover:text-slate-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        Users
                    </a></li>
                <li><a href="#" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-all group">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Settings
                    </a></li>
            </ul>
        </div>
    </nav>
    <!-- User profile snippet moved to navbar, or keep here minimal? I'll remove it to clean up side bar as it's duped in navbar potentially, or keep simpler version -->
    <!-- Keeping simple version at bottom -->
    <div class="p-4">
        <div class="rounded-2xl bg-slate-50 p-4 border border-slate-100">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-full bg-white border border-slate-200 flex items-center justify-center text-brand-600 font-bold shadow-sm">
                    {{ auth()->user()->initials ?? 'A' }}
                </div>
                <div class="overflow-hidden">
                    <div class="text-sm font-bold text-slate-800 truncate">{{ auth()->user()->name ?? 'Admin' }}</div>
                    <div class="text-xs text-slate-500 truncate">View Profile</div>
                </div>
            </div>
        </div>
    </div>
</aside>