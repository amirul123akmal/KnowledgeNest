@extends('layout.guest')

@section('content')
    <style>
        /* Reuse glass and playful helpers */
        .glass {
            background: linear-linear(180deg, rgba(255, 255, 255, 0.78), rgba(255, 255, 255, 0.62));
            backdrop-filter: blur(6px);
        }

        .avatar {
            width: 118px;
            height: 118px;
            border-radius: 18px;
            object-fit: cover;
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.08);
            border: 6px solid rgba(255, 255, 255, 0.7);
        }

        .floating-bubble {
            animation: floaty 6s ease-in-out infinite;
        }

        @keyframes floaty {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }

            100% {
                transform: translateY(0);
            }
        }
    </style>
    <main class="max-w-4xl mx-auto pt-24 pb-14 [&_button]:cursor-pointer">
        <div class="glass rounded-2xl shadow-card border border-white/60 p-6 md:p-8 grid grid-cols-1 md:grid-cols-3 gap-6 items-start">

            <!-- Left column: Avatar + quick stats (amusing & simple) -->
            <aside class="md:col-span-1 flex flex-col items-center gap-4">
                <div class="relative">
                    <img id="avatarPreview" src="{{ strpos($user->picture, 'https://') === 0 ? $user->picture : Storage::url($user->picture) }}" alt="avatar" class="avatar" />
                    <div class="absolute -right-2 -top-2 bg-white rounded-full p-1 shadow-sm">
                        <svg class="w-5 h-5 text-amber-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 17.3l-5.3 3.1 1.4-6.2L4 9.8l6.4-.6L12 3.5l1.6 5.7 6.4.6-4.1 4.4 1.4 6.2z" />
                        </svg>
                    </div>
                </div>

                <div class="text-center">
                    <h2 id="displayName" class="text-lg font-bold text-slate-800">{{ $user->name }}</h2>
                    <p id="displayRole" class="text-xs text-slate-500">Neighbour • Maker</p>
                </div>

                <div class="w-full grid grid-cols-2 gap-2 mt-2">
                    <div class="text-center p-3 bg-white rounded-lg shadow-soft">
                        <div class="text-sm font-semibold">{{ $posts }}</div>
                        <div class="text-xs text-slate-400">Posts</div>
                    </div>
                    <div class="text-center p-3 bg-white rounded-lg shadow-soft">
                        <div class="text-sm font-semibold">4.6</div>
                        <div class="text-xs text-slate-400">Rating</div>
                    </div>
                </div>

                <div class="mt-3 text-xs text-slate-500 text-center">
                    Keep your profile friendly — neighbours are more likely to reach out when they see a welcoming face!
                </div>

                <div class="mt-2">
                    <button id="deleteBtn" class="px-3 py-2 rounded-lg text-sm bg-white border text-rose-600 hover:brightness-95">Delete account</button>
                </div>
            </aside>

            <!-- Right column: Profile form -->
            <section class="md:col-span-2">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h1 class="text-2xl font-extrabold text-slate-800">Profile</h1>
                        <p class="text-sm text-slate-500">Update your details below. Only a few fields to keep it tidy and fun.</p>
                    </div>

                    <div class="flex items-center gap-2">
                        <div class="text-xs text-slate-400">Status: <span id="statusBadge" class="font-medium text-emerald-600">Active</span></div>
                        <div class="w-8 h-8 rounded-full bg-linear-to-br from-primary-300 to-accent flex items-center justify-center floating-bubble">
                            <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 5v14M5 12h14" />
                            </svg>
                        </div>
                    </div>
                </div>

                <form id="profileForm" action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5 bg-white rounded-xl p-5 shadow-soft border border-white/60">
                    @csrf
                    @method('PATCH')
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-2">Full name</label>
                        <input id="name" name="name" type="text" value="{{ $user->name }}" required placeholder="Jane Doe" class="w-full rounded-lg border border-slate-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary-300" />
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                        <input id="email" name="email" type="email" value="{{ $user->email }}" required placeholder="you@neighbourhood.com" class="w-full rounded-lg border border-slate-200 px-4 py-3 text-sm bg-slate-50 focus:outline-none" />
                        <p class="text-xs text-slate-400 mt-1">We will use this for notifications. Email must be unique.</p>
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-slate-700 mb-2">Phone</label>
                        <input id="phone" name="phone" type="tel" value="{{ $user->phone }}" inputmode="tel" required placeholder="+1 555 555 5555" class="w-full rounded-lg border border-slate-200 px-4 py-3 text-sm focus:outline-none" />
                    </div>

                    <!-- Passwords -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                            <div class="relative">
                                <input id="password" name="password" type="password" minlength="6" placeholder="New password" class="w-full rounded-lg border border-slate-200 px-4 py-3 text-sm focus:outline-none" />
                                <button type="button" id="togglePw" class="absolute right-2 top-2.5 text-slate-500 p-1 rounded hover:bg-slate-50">
                                    <svg id="eyeOpen" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M2.5 12s3.5-6.5 9.5-6.5S21.5 12 21.5 12 18 18.5 12 18.5 2.5 12 2.5 12z" />
                                    </svg>
                                </button>
                            </div>
                            <p id="pwHelp" class="text-xs text-slate-400 mt-1">Leave blank to keep current password.</p>
                        </div>

                        <div>
                            <label for="pwConfirm" class="block text-sm font-medium text-slate-700 mb-2">Confirm password</label>
                            <input id="pwConfirm" name="pwConfirm" type="password" placeholder="Confirm new password" class="w-full rounded-lg border border-slate-200 px-4 py-3 text-sm focus:outline-none" />
                            <p id="pwErr" class="text-xs text-rose-500 mt-1 hidden">Passwords do not match.</p>
                        </div>
                    </div>

                    <!-- Picture upload -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Picture</label>
                        <div class="flex items-center gap-4">
                            <div class="w-28 h-28 rounded-xl overflow-hidden border border-slate-100">
                                <img id="miniPreview" src="{{ strpos($user->picture, 'https://') === 0 ? $user->picture : Storage::url($user->picture) }}" alt="preview" class="w-full h-full object-cover" />
                            </div>

                            <div class="flex-1">
                                <label for="picture" class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-white border cursor-pointer hover:shadow-sm">
                                    <svg class="w-5 h-5 text-slate-700" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 5v14M5 12h14" />
                                    </svg>
                                    <span class="text-sm text-slate-700">Upload photo</span>
                                </label>
                                <input id="picture" name="picture" type="file" accept="image/*" class="hidden" />
                                <div class="text-xs text-slate-400 mt-2">Square images work best. Max 2MB.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-between gap-4">
                        <div class="text-xs text-slate-500">Profile last updated: <span id="updatedAt">{{ $user->updated_at->diffForHumans() }}</span></div>
                        <div class="flex items-center gap-3">
                            <button type="button" id="cancelBtn" class="px-4 py-2 rounded-lg bg-white border text-sm hover:shadow hover:scale-105 border-amber-500 text-amber-500">Cancel</button>
                            <button type="submit" id="saveBtn" class="px-5 py-2 rounded-lg bg-green-500 text-white font-semibold shadow hover:scale-105 hover:shadow">Save changes</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </main>
    @if (@session('success'))
        <script>
            @onload
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'Great!'
            });
            @endonload
        </script>
    @endif
    <!-- Minimal JS: preview, validation, fake submit -->
    <script>
            (function () {
                // Cached elements
                const form = document.getElementById('profileForm');
                const nameInput = document.getElementById('name');
                const emailInput = document.getElementById('email');
                const phoneInput = document.getElementById('phone');
                const pwInput = document.getElementById('password');
                const pwConfirm = document.getElementById('pwConfirm');
                const pwErr = document.getElementById('pwErr');
                const pictureInput = document.getElementById('picture');
                const saveBtn = document.getElementById('saveBtn');
                const cancelBtn = document.getElementById('cancelBtn');
                const deleteBtn = document.getElementById('deleteBtn');

                // image preview
                pictureInput.addEventListener('change', (e) => {
                    const file = e.target.files && e.target.files[0];
                    if (!file) return;
                    if (!file.type.startsWith('image/')) { alert('Please select an image file.'); return; }
                    if (file.size > 2 * 1024 * 1024) { alert('Image too large. Max 2MB.'); return; }
                    const url = URL.createObjectURL(file);
                    avatarPreview.src = url;
                    miniPreview.src = url;
                });

                // password toggle
                document.getElementById('togglePw').addEventListener('click', () => {
                    const isPassword = pwInput.type === 'password';
                    pwInput.type = isPassword ? 'text' : 'password';
                    pwConfirm.type = isPassword ? 'text' : 'password';
                });

                // cancel resets to serverData snapshot
                cancelBtn.addEventListener('click', () => {
                    if (confirm('Revert unsaved changes?')) populate(serverData);
                    pwInput.value = pwConfirm.value = '';
                    pwErr.classList.add('hidden');
                });

                // delete account (demo)
                deleteBtn.addEventListener('click', () => {
                    if (confirm('Are you sure you want to delete your account? This is irreversible (demo).')) {
                        alert('Account deleted (demo). Implement server-side deletion.');
                        // Redirect or cleanup in real app
                    }
                });

                // form submit
                form.addEventListener('submit', (e) => {
                    e.preventDefault();
                    pwErr.classList.add('hidden');

                    const name = nameInput.value.trim();
                    const email = emailInput.value.trim();
                    const phone = phoneInput.value.trim();
                    const pw = pwInput.value;
                    const pwc = pwConfirm.value;

                    if (!name) return alert('Please enter your name.');
                    if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) return alert('Please enter a valid email.');
                    if (!phone || !/\+?\d[\d\s\-]{6,}$/.test(phone)) return alert('Please enter a valid phone number.');

                    if (pw || pwc) {
                        if (pw.length < 6) { alert('Password must be at least 6 characters.'); return; }
                        if (pw !== pwc) { pwErr.classList.remove('hidden'); return; }
                    }

                    // Prepare payload
                    const payload = new FormData();
                    payload.append('name', name);
                    payload.append('email', email);
                    payload.append('phone', phone);
                    if (pw) payload.append('password', pw);
                    if (pictureInput.files[0]) payload.append('picture', pictureInput.files[0]);

                    // UI feedback
                    saveBtn.disabled = true;
                    saveBtn.textContent = 'Saving...';

                    form.submit();
                });
            }());
    </script>
@endsection