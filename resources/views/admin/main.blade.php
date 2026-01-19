@extends('layout.admin')

@section('content')
    <main class="p-6 md:p-8 flex-1 overflow-y-auto">
        <!-- Header & Date -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Overview</h1>
                <p class="text-slate-500">Welcome back, here's what's happening today.</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="px-4 py-2 bg-white rounded-2xl border border-slate-200 shadow-sm text-sm font-medium text-slate-600 flex items-center gap-2">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    {{ now()->format('M d, Y') }}
                </div>
            </div>
        </div>

        <!-- Top Stats -->
        <div class="grid gap-6 md:grid-cols-3 mb-8">
            <!-- Total Posts Card -->
            <div class="card p-6 md:col-span-2 relative overflow-hidden group">
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Total Posts</h3>
                        <div class="text-4xl font-extrabold text-slate-900 tracking-tight">{{ $stats['totalPosts'] ?? $totalPosts ?? 0 }}</div>
                    </div>
                     <div class="flex flex-col items-end">
                        <div class="flex items-center gap-1 text-sm font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                            {{ $stats['postsChangePercent'] ?? 12 }}%
                        </div>
                        <div class="text-xs text-slate-400 mt-1 font-medium">vs last month</div>
                    </div>
                </div>
                <!-- Artistic decoration -->
                <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-brand-50 rounded-full blur-2xl group-hover:bg-brand-100 transition-colors duration-700"></div>
            </div>

            <!-- Quick Search / Filter Card -->
            <div class="card p-6 bg-linear-to-br from-slate-900 to-slate-800 text-white border-none shadow-xl relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Quick Filter
                    </h3>
                    <form method="GET" action="{{ route('admin.index') }}" class="space-y-3">
                        <div class="relative">
                            <input name="q" value="{{ request('q') }}" type="search" placeholder="Search posts..." class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-2.5 text-sm placeholder:text-white/50 focus:outline-none focus:ring-2 focus:ring-brand-500/50 text-white" />
                        </div>
                        <div class="flex gap-2">
                            <select name="status" class="flex-1 bg-white/10 border border-white/20 rounded-xl px-3 py-2.5 text-sm text-white focus:outline-none focus:ring-2 focus:ring-brand-500/50 [&>option]:text-slate-900">
                                <option value="">Status</option>
                                <option value="published" @selected(request('status') == 'published')>Published</option>
                                <option value="pending" @selected(request('status') == 'pending')>Pending</option>
                            </select>
                            <button type="submit" class="bg-brand-500 hover:bg-brand-400 text-white p-2.5 rounded-xl transition-colors shadow-lg shadow-brand-500/20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>
                    </form>
                </div>
                 <div class="absolute top-0 right-0 -mr-8 -mt-8 w-40 h-40 bg-brand-500/20 rounded-full blur-3xl"></div>
            </div>
        </div>

        <!-- Charts Area -->
        <div class="grid gap-6 lg:grid-cols-3 mb-8">
            <div class="card p-6 lg:col-span-2">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">Posts by Category</h3>
                        <p class="text-xs text-slate-500 font-medium">Distribution across topics</p>
                    </div>
                    <button class="p-2 hover:bg-slate-50 rounded-lg text-slate-400 hover:text-slate-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                    </button>
                </div>
                <div class="relative h-64 w-full">
                    <canvas id="postsCategoryChart"></canvas>
                </div>
            </div>

            <div class="card p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                         <h3 class="text-lg font-bold text-slate-800">New Users</h3>
                         <p class="text-xs text-slate-500 font-medium">Last 30 days growth</p>
                    </div>
                </div>
                <div class="relative h-64 w-full">
                    <canvas id="usersChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent Posts Table -->
        <section class="card p-0 overflow-hidden">
            <div class="p-6 border-b border-slate-50 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-800">Recent Posts</h3>
                <a href="#" class="text-sm font-semibold text-brand-600 hover:text-brand-700 hover:underline">View All</a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 font-semibold text-slate-600 uppercase tracking-wider text-xs">Post</th>
                            <th class="px-6 py-4 font-semibold text-slate-600 uppercase tracking-wider text-xs">Tags</th>
                            <th class="px-6 py-4 font-semibold text-slate-600 uppercase tracking-wider text-xs text-center">Stats</th>
                            <th class="px-6 py-4 font-semibold text-slate-600 uppercase tracking-wider text-xs text-center">Status</th>
                            <th class="px-6 py-4 font-semibold text-slate-600 uppercase tracking-wider text-xs text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($posts as $post)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="h-12 w-12 rounded-xl overflow-hidden shrink-0 shadow-sm border border-slate-100">
                                            <img src="{{ $post->thumbnail ? Storage::url($post->thumbnail) : asset('images/post.jpg') }}" alt="" class="h-full w-full object-cover" />
                                        </div>
                                        <div class="min-w-0 max-w-xs">
                                            <div class="font-bold text-slate-900 truncate">{{ $post->title }}</div>
                                            <div class="text-xs text-slate-500 truncate mt-0.5">{{ Str::limit($post->excerpt ?? '', 50) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1">
                                        @php
                                            $postDataTags = is_string($post->tags) ? json_decode($post->tags, true) : $post->tags;
                                            // Handle double encoding if necessary
                                            if (is_string($postDataTags)) {
                                                $postDataTags = json_decode($postDataTags, true);
                                            }
                                        @endphp
                                        @foreach(($postDataTags ?? []) as $tag)
                                            <span class="inline-flex items-center px-2 py-1 rounded-md bg-white border border-slate-200 text-xs font-semibold text-slate-600">
                                                {{ is_array($tag) ? ($tag['value'] ?? '') : $tag }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="inline-flex items-center gap-3 px-3 py-1 bg-slate-50 rounded-lg border border-slate-100">
                                        <div class="flex items-center gap-1 text-slate-600" title="Views">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            <span class="font-bold text-xs">{{ $post->views ?? 0 }}</span>
                                        </div>
                                        <div class="w-px h-3 bg-slate-300"></div>
                                        <div class="flex items-center gap-1 text-emerald-600" title="Upvotes">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                                            <span class="font-bold text-xs">{{ $post->upvote ?? 0 }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($post->status === 'published')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-600 border border-emerald-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Published
                                        </span>
                                    @elseif($post->status === 'pending')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-600 border border-amber-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Pending
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-500 border border-slate-200">
                                            Draft
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        @if($post->status === 'pending')
                                            <form method="POST" action="">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="p-2 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition-colors" title="Approve">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                </button>
                                            </form>
                                        @endif
                                        <a href="" class="p-2 rounded-lg bg-slate-50 text-slate-500 hover:bg-slate-100 hover:text-brand-600 transition-colors" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>

                                        <form method="POST" action="" onsubmit="return confirm('Delete this post?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-lg bg-red-50 text-red-500 hover:bg-red-100 transition-colors" title="Delete">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-slate-400">
                                        <svg class="w-12 h-12 mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        <p class="text-sm font-medium">No posts found</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
             @if(method_exists($posts, 'links'))
                <div class="p-4 border-t border-slate-50">
                    {{ $posts->withQueryString()->links() }}
                </div>
            @endif
        </section>

        <footer class="mt-8 mb-4 text-center">
            <p class="text-xs font-semibold text-slate-400">
                © {{ date('Y') }} Knowledge Nest <span class="mx-1">•</span> Crafted with <span class="text-red-400">❤</span> for the community
            </p>
        </footer>
    </main>

    <script>
        const KN_DATA = {
            tags: {!! json_encode($tags ?? []) !!},
            tagCounts: {!! json_encode($tagCountsValues ?? []) !!},
            usersLabels: {!! json_encode($usersLabels ?? []) !!},
            usersData: {!! json_encode($usersData ?? []) !!}
        };

        document.addEventListener('DOMContentLoaded', function () {
            Chart.defaults.font.family = "'Instrument Sans', sans-serif";
            Chart.defaults.color = '#64748b';
            
            // Posts by Category chart
            const ctx1 = document.getElementById('postsCategoryChart');
            if (ctx1 && KN_DATA.tags && KN_DATA.tags.length) {
                new Chart(ctx1.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: KN_DATA.tags,
                        datasets: [{
                            label: 'Posts',
                            data: KN_DATA.tagCounts,
                            backgroundColor: '#2dd4bf',
                            borderRadius: 8,
                            hoverBackgroundColor: '#14b8a6',
                            barThickness: 24
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: { 
                            y: { 
                                beginAtZero: true, 
                                grid: { color: '#f1f5f9', drawBorder: false },
                                ticks: { stepSize: 1, padding: 10 }
                            },
                            x: {
                                grid: { display: false },
                                ticks: { padding: 10 }
                            }
                        }
                    }
                });
            }

            // New Users chart
            const ctx2 = document.getElementById('usersChart');
            if (ctx2 && KN_DATA.usersLabels && KN_DATA.usersLabels.length) {
                new Chart(ctx2.getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: KN_DATA.usersLabels,
                        datasets: [{
                            label: 'New users',
                            data: KN_DATA.usersData,
                            borderColor: '#6366f1',
                            borderWidth: 3,
                            backgroundColor: (ctx) => {
                                const g = ctx.createLinearGradient(0, 0, 0, 300);
                                g.addColorStop(0, 'rgba(99, 102, 241, 0.2)');
                                g.addColorStop(1, 'rgba(99, 102, 241, 0)');
                                return g;
                            },
                            fill: true,
                            tension: 0.4,
                            pointRadius: 4,
                            pointBackgroundColor: '#ffffff',
                            pointBorderColor: '#6366f1',
                            pointBorderWidth: 2,
                            pointHoverRadius: 6
                        }]
                    },
                    options: { 
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false }, tooltip: {
                            backgroundColor: '#1e293b',
                            padding: 12,
                            cornerRadius: 12,
                            displayColors: false
                        }}, 
                        scales: { 
                             y: { 
                                beginAtZero: true, 
                                grid: { color: '#f1f5f9', drawBorder: false },
                                ticks: { padding: 10 }
                            },
                            x: {
                                grid: { display: false },
                                ticks: { padding: 10 }
                            }
                        } 
                    }
                });
            }
        });
    </script>
@endsection