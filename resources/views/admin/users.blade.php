@extends('layout.admin')

@section('content')
    <!-- BODY: Users admin page -->
    <div x-data="usersApp()" x-init="init()" class="p-4 md:p-6 flex-1 overflow-y-auto">

        <!-- top stats + filters + actions -->
        <div class="mb-6 grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-6">
            <!-- Total users -->
            <div class="card bg-white p-4 rounded-lg lg:col-span-1">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm text-slate-500">Total users</h3>
                        <div class="mt-1 text-2xl font-semibold text-nest-700">{{ $totalUsers ?? 0 }}</div>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-slate-400">Active</div>
                        <div class="mt-1 text-sm text-slate-600">{{ $activeUsers ?? 0 }}</div>
                    </div>
                </div>
            </div>

            <!-- New Users -->
            <div class="card bg-white p-4 rounded-lg lg:col-span-1">
                <div>
                    <h3 class="text-sm text-slate-500">New Users</h3>
                    <div class="mt-1 text-xl font-semibold text-accent-500">{{ $newUsers ?? 0 }}</div>
                    <div class="mt-2 text-xs text-slate-400">Last 30 days</div>
                </div>
            </div>

            <!-- Quick actions -->
            <div class="card bg-white p-4 rounded-lg lg:col-span-1">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-sm font-medium">Quick actions</h3>
                    <div class="text-xs text-slate-400">Batch tools</div>
                </div>
                <div class="space-y-3">
                    <form method="POST" action="{{---- route('users.bulk') ----}}" id="bulkForm" x-ref="bulkForm">
                        @csrf
                        <input type="hidden" name="action" x-model="bulkAction" />
                        <input type="hidden" name="ids" :value="selectedIds.join(',')" />
                        <div>
                            <label class="text-xs text-slate-500">Bulk action</label>
                            <select x-model="bulkAction" class="mt-1 w-full border border-slate-100 rounded-md px-3 py-2 text-sm">
                                <option value="">Select action</option>
                                <option value="activate">Activate</option>
                                <option value="deactivate">Deactivate</option>
                                <option value="delete">Delete</option>
                            </select>
                        </div>
                        <div class="pt-3">
                            <button type="button" @click="submitBulk" class="w-full px-3 py-2 rounded-md bg-nest-500 text-white">Apply</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Search -->
            <div class="card bg-white p-4 rounded-lg md:col-span-2 lg:col-span-3">
                <form method="GET" action="{{ route('users.index') }}" class="space-y-3">
                    <div>
                        <label class="text-xs text-slate-500">Search users</label>
                        <div class="mt-2 flex gap-2">
                            <input name="q" value="{{ request('q') }}" type="search" placeholder="Name, email, phone..." class="flex-1 border border-slate-100 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-nest-300" />
                            <button type="submit" class="px-3 py-2 rounded-md bg-nest-500 text-white text-sm">Search</button>
                        </div>
                        <div class="mt-3 text-xs text-slate-500">
                            Showing <span class="font-semibold text-slate-700">{{ $users->count() ?? 0 }}</span> of <span class="font-semibold text-slate-700">{{ $users->total() ?? 0 }}</span> users
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="text-xs text-slate-500">Role</label>
                            <select name="role" class="mt-1 w-full border border-slate-100 rounded-md px-3 py-2 text-sm bg-white">
                                <option value="">Any role</option>
                                @foreach($roles ?? [] as $r)
                                    <option value="{{ $r }}" @selected(request('role') == $r)>{{ $r }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="text-xs text-slate-500">Status</label>
                            <select name="status" class="mt-1 w-full border border-slate-100 rounded-md px-3 py-2 text-sm bg-white">
                                <option value="">Any</option>
                                <option value="active" @selected(request('status') == 'active')>Active</option>
                                <option value="suspended" @selected(request('status') == 'suspended')>Suspended</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{-- route('users.create') --}}" class="px-3 py-2 bg-accent-500 text-white rounded-md text-sm">Invite</a>
                        <a href="{{-- route('users.export') --}}?{{ http_build_query(request()->all()) }}" class="px-3 py-2 bg-nest-50 text-nest-700 rounded-md text-sm">Export CSV</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Users table -->
        <section class="card bg-white p-4 rounded-lg">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold flex items-center gap-2">
                    <span>All users</span>
                    <span class="inline-block px-2 py-1 text-xs bg-slate-50 rounded-md text-slate-500">{{ $users->total() ?? 0 }}</span>
                </h3>

                <div class="flex items-center gap-2">
                    <form method="GET" action="{{ route('users.index') }}">
                        <input type="hidden" name="q" value="{{ request('q') }}" />
                        <select name="sort" onchange="this.form.submit()" class="text-sm border border-slate-100 rounded-md px-3 py-2 bg-white">
                            <option value="newest" @selected(request('sort', 'newest') == 'newest')>Newest</option>
                            <option value="oldest" @selected(request('sort') == 'oldest')>Oldest</option>
                            <option value="name_asc" @selected(request('sort') == 'name_asc')>Name A–Z</option>
                        </select>
                    </form>
                </div>
            </div>

            <div class="table-scroll">
                <table class="w-full text-sm">
                    <thead class="text-slate-500 text-xs uppercase">
                        <tr>
                            <th class="py-2 pl-3">
                                <input type="checkbox" @click="toggleAll" x-model="allChecked" />
                            </th>
                            <th class="text-left py-2">User</th>
                            <th class="text-left py-2">Email</th>
                            <th class="text-left py-2">Phone</th>
                            <th class="text-left py-2">Role</th>
                            <th class="py-2 text-center">Status</th>
                            <th class="py-2 text-center">Joined</th>
                            <th class="py-2 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($users as $user)
                            <tr>
                                <td class="py-3 pl-3">
                                    <input type="checkbox" value="{{ $user->id }}" x-model="selectedIds" />
                                </td>
                                <td class="py-3">
                                    <div class="flex items-center gap-3">
                                        @php $img = $user->picture ?? null; @endphp
                                        <div class="size-10 rounded-full avatar bg-cover bg-center" style="background-image: url('{{ $img ? Storage::url($img) : asset('images/profile.jpg') }}')"></div>
                                        <div>
                                            <div class="font-medium">{{ $user->name }}</div>
                                            <div class="text-xs text-slate-400">{{ $user->role }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3">{{ $user->email }}</td>
                                <td class="py-3">{{ $user->phone ?? '-' }}</td>
                                <td class="py-3">{{ $user->role }}</td>
                                <td class="py-3 text-center">
                                    @if($user->status === 'active')
                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">active</span>
                                    @else
                                        <span class="bg-red-50 text-red-600 px-2 py-1 rounded-full text-xs">{{ $user->status }}</span>
                                    @endif
                                </td>
                                <td class="py-3 text-center">{{ optional($user->created_at)->format('Y-m-d') ?? '-' }}</td>
                                <td class="py-3 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('users.edit', $user->id) }}" class="text-xs bg-slate-50 px-2 py-1 rounded-md hover:bg-slate-100 transition-colors">Edit</a>

                                        <form method="POST" action="{{-- route('users.destroy', $user->id) --}}" onsubmit="return confirm('Delete user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs bg-red-50 text-red-600 px-2 py-1 rounded-md">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-6 text-center text-slate-500">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                @if(method_exists($users, 'links'))
                    {{ $users->withQueryString()->links() }}
                @endif
            </div>
        </section>
    </div>
    <!-- /BODY -->

    <script>
        function usersApp() {
            return {
                allChecked: false,
                selectedIds: [],
                bulkAction: '',
                init() {

                },
                toggleAll() {
                    this.allChecked = !this.allChecked;
                    this.selectedIds = [];
                    const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');
                    if (this.allChecked) {
                        checkboxes.forEach(cb => {
                            cb.checked = true;
                            if (cb.value) this.selectedIds.push(cb.value);
                        });
                    } else {
                        checkboxes.forEach(cb => cb.checked = false);
                        this.selectedIds = [];
                    }
                },
                submitBulk() {
                    if (!this.bulkAction) { alert('Select an action'); return; }
                    if (this.selectedIds.length === 0) { alert('Select users first'); return; }
                    if (this.bulkAction === 'delete' && !confirm('Delete selected users?')) return;

                    // submit the form (we also have the form in DOM; use it)
                    const form = document.getElementById('bulkForm');
                    if (form) {
                        form.submit();
                    }
                }
            }
        }




    </script>
@endsection