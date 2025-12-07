@extends('layout.admin')

@section('content')
    <main class="p-4 md:p-6 flex-1 overflow-y-auto">

        <!-- top stats & server-driven filter form -->
        <div class="mb-6 grid gap-4 md:grid-cols-3">
            <div class="flex gap-4 md:col-span-2">
                <div class="card bg-white p-4 rounded-lg flex-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm text-slate-500">Total Posts</h3>
                            <div class="mt-1 text-2xl font-semibold text-nest-700">{{ $stats['totalPosts'] ?? $totalPosts ?? 0 }}</div>
                        </div>
                        <div class="text-right">
                            <div class="text-xs text-slate-400">Last 30 days</div>
                            <div class="mt-1 text-sm text-slate-600">+ {{ $stats['postsChangePercent'] ?? 0 }}%</div>
                        </div>
                    </div>
                </div>

                <div class="card bg-white p-4 rounded-lg">
                    <div>
                        <h3 class="text-sm text-slate-500">Active Shops</h3>
                        <div class="mt-1 text-xl font-semibold text-nest-700">{{ $stats['activeShops'] ?? 0 }}</div>
                        <div class="mt-2 text-xs text-slate-400">Active in last 7 days</div>
                    </div>
                </div>

                <div class="card bg-white p-4 rounded-lg">
                    <div>
                        <h3 class="text-sm text-slate-500">Pending Approvals</h3>
                        <div class="mt-1 text-xl font-semibold text-accent-500">{{ $stats['pending'] ?? 0 }}</div>
                        <div class="mt-2 text-xs text-slate-400">Require review</div>
                    </div>
                </div>
            </div>

            <div class="card bg-white p-4 rounded-lg">
                <form method="GET" action="{{ route('admin.index') }}" class="space-y-3">
                    <div>
                        <label class="text-xs text-slate-500">Search posts</label>
                        <div class="mt-2 flex gap-2">
                            <input name="q" value="{{ request('q') }}" type="search" placeholder="Search title, shop, category..." class="flex-1 border border-slate-100 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-nest-300" />
                            <button type="submit" class="px-3 py-2 rounded-md bg-nest-500 text-white text-sm">Search</button>
                        </div>
                        <div class="mt-3 text-xs text-slate-500">
                            Showing <span class="font-semibold text-slate-700">{{ $filteredCount ?? $posts->count() ?? 0 }}</span> of <span class="font-semibold text-slate-700">{{ $totalPosts ?? $stats['totalPosts'] ?? ($posts_total ?? 0) }}</span> posts
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="text-xs text-slate-500">Category</label>
                            <select name="category" class="mt-1 w-full border border-slate-100 rounded-md px-3 py-2 text-sm bg-white">
                                <option value="">All categories</option>
                                @foreach(($categories ?? []) as $c)
                                    <option value="{{ $c }}" @selected(request('category') == $c)>{{ $c }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="text-xs text-slate-500">Status</label>
                            <select name="status" class="mt-1 w-full border border-slate-100 rounded-md px-3 py-2 text-sm bg-white">
                                <option value="">Any</option>
                                <option value="published" @selected(request('status ') == 'published')>Published</option>
                                <option value="pending" @selected(request('status ') == 'pending')>Pending</option>
                                <option value="draft" @selected(request('status') == 'draft')>Draft</option>
                            </select>
                        </div>

                        <div>
                            <label class="text-xs text-slate-500">Timeframe</label>
                            <select name="days" class="mt-1 w-full border  b order-slate-100 rounded-md px-3 py-2 text-sm bg-white">
                                <option value="7" @selected(request('days') == '7 ')>Last 7 days</option>
                                <option value="30" @selected(request('days', ' 30') == '30')>Last 30 days</option>
                                <option value="90" @selected(request('days') == '90')>Last 90 days</option>
                                <option value="365" @selected(request('days') == '365')>Year</option>
                            </select>
                        </div>

                        <div>
                            <label class="text-xs text-slate-500">Sort</label>
                            <select name="sort" class="mt-1 w-full border bord er-slate- 10 0 rounded-md px-3 py-2 text-sm bg-white">
                                <option value="newest" @selected(request('sort', ' newest') == 'newest')>Newest</option>
                                <option value="oldest" @selected(request('sort') == ' ol dest')>Oldest</option>
                                <option value="most-viewed" @selected(request('sort') == 'most-viewed')>Most viewed</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="" class="px-3 py-2 bg-accent-500 text-white rounded-md text-sm">New Post</a>
                        <a href="" class="px-3 py-2 bg-nest-50 text-nest-700 rounded-md text-sm">Export CSV</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Charts area -->
        <div class="grid gap-6 lg:grid-cols-3 mb-6">
            <div class="card bg-white p-4 rounded-lg lg:col-span-2">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-sm font-medium">Posts by Category</h3>
                    <div class="text-xs text-slate-400">Updated recently</div>
                </div>
                <canvas id="postsCategoryChart" height="160"></canvas>
            </div>

            <div class="card bg-white p-4 rounded-lg">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-sm font-medium">New Users</h3>
                    <div class="text-xs text-slate-400">Past 30 days</div>
                </div>
                <canvas id="usersChart" height="160"></canvas>
            </div>
        </div>

        <!-- Recent posts table -->
        <section class="card bg-white p-4 rounded-lg">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold">Recent Posts</h3>
                <div class="flex items-center gap-3">
                    <a href="" class="px-3 py-2 bg-accent-500 text-white rounded-md text-sm">New Post</a>
                </div>
            </div>

            <div class="table-scroll">
                <table class="w-full text-sm">
                    <thead class="text-slate-500 text-xs uppercase">
                        <tr>
                            <th class="text-left py-2">Post</th>
                            <th class="text-left py-2">Shop</th>
                            <th class="py-2 text-left">Category</th>
                            <th class="py-2">Views</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Date</th>
                            <th class="py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($posts as $post)
                            <tr>
                                <td class="py-3">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $post->thumb ?? asset('images/placeholder.png') }}" alt="" class="h-12 w-12 rounded-md object-cover" />
                                        <div>
                                            <div class="font-medium">{{ $post->title }}</div>
                                            <div class="text-xs text-slate-400">{{ Str::limit($post->excerpt ?? '', 70) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3">{{ $post->shop->name ?? $post->shop }}</td>
                                <td class="py-3">{{ $post->category }}</td>
                                <td class="py-3 text-center">{{ $post->views ?? 0 }}</td>
                                <td class="py-3 text-center">
                                    @if($post->status === 'published')
                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">published</span>
                                    @elseif($post->status === 'pending')
                                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs">pending</span>
                                    @else
                                        <span class="bg-slate-100 text-slate-700 px-2 py-1 rounded-full text-xs">{{ $post->status }}</span>
                                    @endif
                                </td>
                                <td class="py-3 text-center">{{ $post->created_at->format('Y-m-d') ?? \Carbon\Carbon::parse($post->date ?? now())->toDateString() }}</td>
                                <td class="py-3 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        @if($post->status === 'pending')
                                            <form method="POST" action="">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-xs bg-nest-500 text-white px-2 py-1 rounded-md">Approve</button>
                                            </form>
                                        @endif
                                        <a href="" class="text-xs bg-slate-50 px-2 py-1 rounded-md">Edit</a>

                                        <form method="POST" action="" onsubmit="return confirm('Delete this post?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs bg-red-50 text-red-600 px-2 py-1 rounded-md">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-6 text-center text-slate-500">No posts found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{-- Pagination (if using) --}}
                @if(method_exists($posts, 'links'))
                    {{ $posts->withQueryString()->links() }}
                @endif
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="mt-6 text-xs text-slate-400">
            © {{ date('Y') }} Knowledge Nest — Share skills and info among neighbours.
        </footer>

    </main>
    <script>
        // Prepare data for charts: Controller should pass:
        // $categories (array of labels), $categoryCounts (array of ints matching categories)
        // $usersLabels (array), $usersData (array)
        // This template expects these variables. If not provided, charts will be empty.

        const KN_DATA = {
            categories: {!! json_encode($categories ?? []) !!},
            categoryCounts: {!! json_encode($categoryCounts ?? []) !!},
            usersLabels: {!! json_encode($usersLabels ?? []) !!},
            usersData: {!! json_encode($usersData ?? []) !!}
        };

        document.addEventListener('DOMContentLoaded', function () {
            // Posts by Category chart
            const ctx1 = document.getElementById('postsCategoryChart');
            if (ctx1 && KN_DATA.categories.length) {
                new Chart(ctx1.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: KN_DATA.categories,
                        datasets: [{
                            label: 'Posts',
                            data: KN_DATA.categoryCounts,
                            backgroundColor: ['#2bb89a', '#4fd1a6', '#8fe0c9', '#4fd1a6', '#2bb89a', '#23977f'],
                            borderRadius: 6
                        }]
                    },
                    options: {
                        plugins: { legend: { display: false } },
                        scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
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
                            borderColor: '#ff5a3f',
                            backgroundColor: (ctx) => {
                                const g = ctx.createLinearGradient(0, 0, 0, 200);
                                g.addColorStop(0, '#ff5a3f33');
                                g.addColorStop(1, '#ff5a3f05');
                                return g;
                            },
                            fill: true,
                            tension: 0.35,
                            pointRadius: 3
                        }]
                    },
                    options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
                });
            }
        });
    </script>
@endsection