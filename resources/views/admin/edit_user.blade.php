@extends('layout.admin')

@section('content')
    <div class="p-4 md:p-6 flex-1 overflow-y-auto">

        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Edit User</h1>
                    <p class="text-sm text-slate-500 mt-1">Update profile information and permissions for {{ $user->name }}</p>
                </div>
                <a href="{{ route('users.index') }}" class="group flex items-center gap-2 text-sm text-slate-500 hover:text-nest-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 transition-transform group-hover:-translate-x-1">
                        <path d="m15 18-6-6 6-6" />
                    </svg>
                    Back to Users
                </a>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 overflow-hidden">
                <form action="{{ route('users.update', $user->id) }}" method="POST" class="p-6 md:p-8">
                    @csrf
                    @method('PUT')

                    <!-- Profile Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">

                        <!-- Name -->
                        <div class="col-span-2 md:col-span-1">
                            <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Full Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-nest-500 focus:ring-2 focus:ring-nest-500/20 transition-all @error('name') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror">
                            @error('name')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-span-2 md:col-span-1">
                            <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email Address <span class="text-red-500">*</span></label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-nest-500 focus:ring-2 focus:ring-nest-500/20 transition-all @error('email') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror">
                            @error('email')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="col-span-2 md:col-span-1">
                            <label for="phone" class="block text-sm font-medium text-slate-700 mb-1.5">Phone Number</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-nest-500 focus:ring-2 focus:ring-nest-500/20 transition-all @error('phone') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror">
                            @error('phone')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div class="col-span-2 md:col-span-1">
                            <label for="role" class="block text-sm font-medium text-slate-700 mb-1.5">Role <span class="text-red-500">*</span></label>
                            <select name="role" id="role" required class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-nest-500 focus:ring-2 focus:ring-nest-500/20 transition-all appearance-none cursor-pointer">
                                @foreach($roles as $role)
                                    <option value="{{ $role }}" @selected(old('role', $user->role) == $role)>{{ ucfirst($role) }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-span-2 md:col-span-1">
                            <label for="status" class="block text-sm font-medium text-slate-700 mb-1.5">Account Status <span class="text-red-500">*</span></label>
                            <select name="status" id="status" required class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-nest-500 focus:ring-2 focus:ring-nest-500/20 transition-all appearance-none cursor-pointer">
                                <option value="active" @selected(old('status', $user->status) == 'active')>Active</option>
                                <option value="suspended" @selected(old('status', $user->status) == 'suspended')>Suspended</option>
                                <option value="pending" @selected(old('status', $user->status) == 'pending')>Pending</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Verified Toggle -->
                        <div class="col-span-2 md:col-span-1 flex flex-col justify-end pb-2">
                            <div class="flex items-center gap-3">
                                <div class="relative inline-block w-11 h-6 align-middle select-none transition duration-200 ease-in">
                                    <input type="checkbox" name="verified" id="verified" value="1" class="peer toggle-checkbox absolute block w-5 h-5 rounded-full bg-white border-4 appearance-none cursor-pointer border-slate-300 checked:right-0 checked:border-green-500 transition-all duration-200" @checked(old('verified', $user->verified)) />
                                    <label for="verified" class="toggle-label block overflow-hidden h-6 rounded-full bg-slate-200 cursor-pointer peer-checked:bg-green-500/20"></label>
                                </div>
                                <div>
                                    <label for="verified" class="block text-sm font-medium text-slate-700">Verified User</label>
                                    <p class="text-xs text-slate-500">Enable only for trusted accounts.</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <hr class="my-8 border-slate-100">

                    <!-- Password Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <div class="col-span-2">
                            <h3 class="text-sm font-semibold text-slate-900">Change Password</h3>
                            <p class="text-xs text-slate-500">Leave blank to keep the current password.</p>
                        </div>

                        <div class="col-span-2 md:col-span-1">
                            <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">New Password</label>
                            <input type="password" name="password" id="password" autocomplete="new-password" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-nest-500 focus:ring-2 focus:ring-nest-500/20 transition-all @error('password') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror">
                            @error('password')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-10 pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                        <a href="{{ route('users.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors">Cancel</a>
                        <button type="submit" class="px-5 py-2 rounded-lg bg-nest-600 hover:bg-nest-700 text-white text-sm font-medium shadow-sm shadow-nest-500/20 transition-all hover:shadow-md hover:scale-[1.01]">Save Changes</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <style>
        /* Custom toggle styles if Tailwind form plugin not available or specific customization needed */
        .toggle-checkbox:checked {
            right: 0;
            border-color: #10b981;
            /* green-500 */
        }

        .toggle-checkbox:checked+.toggle-label {
            background-color: #d1fae5;
            /* green-100 */
        }

        .toggle-checkbox {
            right: auto;
            left: 0;
            transition: all 0.3s;
        }

        .toggle-checkbox:checked {
            left: calc(100% - 1.25rem);
            /* roughly w-5 */
        }
    </style>
@endsection