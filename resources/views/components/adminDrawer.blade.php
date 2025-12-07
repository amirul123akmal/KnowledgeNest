<!-- NAVBAR (Drawer / Left) -->
<!-- NAVBAR -->
<aside class="bg-white border-r border-slate-100 w-72 flex-shrink-0 hidden md:flex flex-col">
    <div class="px-6 py-6">
        <div class="flex items-center gap-3">
            <div class="h-10 w-10 rounded-lg bg-nest-500 flex items-center justify-center text-white font-bold">KN</div>
            <div>
                <h1 class="text-lg font-semibold">Knowledge Nest</h1>
                <p class="text-xs text-slate-500">Admin Dashboard</p>
            </div>
        </div>
    </div>

    <nav class="px-4 py-2 flex-1">
        <ul class="space-y-1">
            <li>
                <a href="{{ route('admin.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-md bg-nest-100 text-nest-700">
                    <span class="font-medium">Overview</span>
                </a>
            </li>
            <li><a href="{{ route('admin.shops.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-md text-slate-700 hover:bg-slate-50">Shops</a></li>
            <li><a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-md text-slate-700 hover:bg-slate-50">Users</a></li>
            <li><a href="{{ route('admin.settings') }}" class="flex items-center gap-3 px-3 py-2 rounded-md text-slate-700 hover:bg-slate-50">Settings</a></li>
        </ul>
    </nav>

    <div class="px-6 py-4 border-t border-slate-100">
        <div class="text-xs text-slate-500">Signed in as</div>
        <div class="mt-2 flex items-center gap-3">
            <div class="h-8 w-8 rounded-full bg-nest-300 flex items-center justify-center text-nest-800 font-semibold">
                {{ auth()->user()->initials ?? 'A' }}
            </div>
            <div>
                <div class="text-sm font-medium">{{ auth()->user()->name ?? 'Admin' }}</div>
                <div class="text-xs text-slate-500">{{ auth()->user()->email ?? 'admin@knowledge.nest' }}</div>
            </div>
        </div>
    </div>
</aside>
<!-- /NAVBAR -->