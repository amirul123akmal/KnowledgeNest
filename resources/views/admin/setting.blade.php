@extends('layout.admin')

@section('content')
    <main class="p-6 md:p-8 flex-1 overflow-y-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Settings</h1>
                <p class="text-slate-500">Manage your application configuration.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <!-- Search Settings Card -->
            <div class="card p-6 col-span-1 md:col-span-2 lg:col-span-2">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2 bg-brand-50 text-brand-600 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Search Configuration</h3>
                        <p class="text-xs text-slate-500">Fine-tune the search experience.</p>
                    </div>
                </div>

                <form action="{{ route('admin.settings.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <label for="search_threshold" class="block text-sm font-semibold text-slate-700 mb-2">Fuzzy Search Threshold</label>
                            <div class="flex items-center gap-4">
                                <input type="range" id="search_threshold" name="search_threshold" min="0" max="1" step="0.05" value="{{ $search_threshold ?? 0.75 }}" class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-brand-600" oninput="document.getElementById('threshold_value').textContent = this.value">
                                <span id="threshold_value" class="w-12 text-center font-mono font-bold text-brand-600 bg-brand-50 px-2 py-1 rounded-md">{{ $search_threshold ?? 0.75 }}</span>
                            </div>
                            <p class="text-xs text-slate-500 mt-2">
                                Controls how fuzzy the search is. A value of <span class="font-bold text-slate-700">0.0</span> requires a perfect match, while <span class="font-bold text-slate-700">1.0</span> matches anything. Recommended: 0.6 - 0.8.
                            </p>
                        </div>

                        <div>
                            <label for="search_keys" class="block text-sm font-semibold text-slate-700 mb-2">Search Keys</label>
                            <input type="text" id="search_keys" name="search_keys" value="{{ $search_keys_string ?? 'title, content, brief_description, tags, comments.content' }}" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-200 transition-all placeholder-slate-400">
                            <p class="text-xs text-slate-500 mt-2">
                                Comma-separated list of fields to search in. Example: <span class="font-mono text-slate-600">title, content, tags</span>.
                            </p>
                        </div>

                        </p>
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <form action="{{ route('admin.settings.reindex') }}" method="POST" onsubmit="return confirm('Are you sure? This will force the search index to be rebuilt on the next search.');">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-slate-100 hover:bg-red-200 hover:text-red-600 cursor-pointer text-slate-600 font-semibold rounded-lg text-sm transition-colors">
                                    Force Reindex
                                </button>
                            </form>
                        </div>
                        <button type="submit" class="px-5 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-semibold rounded-xl text-sm transition-colors shadow-sm shadow-brand-200">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Placeholder for future settings -->
        <div class="card p-6 flex flex-col items-center justify-center text-center opacity-60 border-dashed border-2 border-slate-200 shadow-none">
            <div class="p-4 bg-slate-50 rounded-full mb-3 text-slate-300">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </div>
            <h3 class="font-semibold text-slate-400">More Settings Coming Soon</h3>
            <p class="text-xs text-slate-400 mt-1">This layout is ready for expansion.</p>
        </div>
        </div>
    </main>
@endsection