@extends('layout.guest')

@section('content')
    <!-- BODY: Registration form only -->
    <main class="min-h-screen flex items-center justify-center p-6 bg-linear-to-b from-primary-50 to-white pt-24 pb-20">
        <div class="w-full max-w-3xl grid grid-cols-1 lg:grid-cols-2 gap-8 items-center"> <!-- Left: visual / micro-copy (hidden on small screens) -->
            <aside class="hidden lg:flex flex-col gap-6 p-6 rounded-2xl bg-white shadow-soft">
                <div class="rounded-xl overflow-hidden h-56 bg-cover bg-center" style="background-image:url('https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=1400&auto=format&fit=crop')"></div>
                <div>
                    <h2 class="text-2xl font-extrabold text-slate-800">Join Knowledge Nest</h2>
                    <p class="text-sm text-slate-600 mt-2">Create your account to share skills, post local services, and connect with neighbours.</p>
                    <ul class="mt-3 text-sm text-slate-500 space-y-2">
                        <li>• Quick sign-up with Google</li>
                        <li>• Secure and neighbourhood-first</li>
                        <li>• Start posting within minutes</li>
                    </ul>
                </div>
                <!-- Google OAuth -->
                <p class="text-sm text-slate-500 mt-1">Sign up with email or continue with Google</p>
                <div class="mb-4">
                    <a href="/auth/google" class="flex items-center justify-center gap-3 w-full py-3 rounded-lg border hover:shadow transition text-sm bg-white">
                        <img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/google.svg" alt="G" class="w-5 h-5" />
                        Continue with Google
                    </a>
                </div>
            </aside>
            <!-- Right: registration card -->
            <section class="bg-white rounded-2xl p-6 shadow-soft border border-white">
                <div class="mb-4">
                    <h1 class="text-2xl font-bold text-slate-800">Create an account</h1>
                </div>
                @if ($errors->any())
                    <div class="mb-4">
                        <ul class="text-sm text-red-500 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Registration form -->
                <form id="registerForm" class="space-y-4" novalidate method="POST" action="{{ route('register.store') }}">
                    @csrf
                    @method('POST')
                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-xs font-medium text-slate-600 mb-2">Phone number</label>
                        <input id="phone" name="phone" type="tel" inputmode="tel" autocomplete="tel" placeholder="01234567890" required class="w-full rounded-lg border border-slate-200 px-4 py-3 text-sm focus:outline-none focus:ring-0 focus:border-transparent" />
                        <p class="text-xs text-rose-500 mt-1 hidden" id="phoneErr">Enter a valid phone number.</p>
                    </div>

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-xs font-medium text-slate-600 mb-2">Full name</label>
                        <input id="name" name="name" type="text" autocomplete="name" placeholder="Amirul Akmal" required class="w-full rounded-lg border border-slate-200 px-4 py-3 text-sm focus:outline-none focus:ring-0 focus:border-transparent" />
                        <p class="text-xs text-rose-500 mt-1 hidden" id="nameErr">Please provide your name.</p>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-xs font-medium text-slate-600 mb-2">Email</label>
                        <input id="email" name="email" type="email" autocomplete="email" placeholder="amirul@gmail.com" required class="w-full rounded-lg border border-slate-200 px-4 py-3 text-sm focus:outline-none focus:ring-0 focus:border-transparent" />
                        <p class="text-xs text-rose-500 mt-1 hidden" id="emailErr">Enter a valid email address.</p>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-xs font-medium text-slate-600 mb-2">Password</label>
                        <div class="relative">
                            <input id="password" name="password" type="password" minlength="6" autocomplete="new-password" placeholder="• • • • • • • •" required class="w-full rounded-lg border border-slate-200 px-4 py-3 text-sm focus:outline-none focus:ring-0 focus:border-transparent" />
                            <button type="button" id="togglePw" class="absolute right-2 top-2.5 text-slate-500 p-1 rounded hover:bg-slate-50">
                                <svg id="eyeOpen" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M2.5 12s3.5-6.5 9.5-6.5S21.5 12 21.5 12 18 18.5 12 18.5 2.5 12 2.5 12z" />
                                </svg>
                                <svg id="eyeClosed" class="w-5 h-5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M3 3l18 18M9.5 9.5a3 3 0 0 1 4 4" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M2.5 12s3.5-6.5 9.5-6.5c3.02 0 5.61 1.5 7.03 3.53M21.5 12s-2.14 3.94-5.79 6.23" />
                                </svg>
                            </button>
                        </div>
                        <p class="text-xs text-rose-500 mt-1 hidden" id="pwErr">Password must be at least 6 characters.</p>
                    </div>

                    <!-- Password confirm -->
                    <div>
                        <label for="password_confirmation" class="block text-xs font-medium text-slate-600 mb-2">Confirm password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" placeholder="Confirm password" required class="w-full rounded-lg border border-slate-200 px-4 py-3 text-sm focus:outline-none focus:ring-0 focus:border-transparent" />
                        <p class="text-xs text-rose-500 mt-1 hidden" id="pwMatchErr">Passwords do not match.</p>
                    </div>

                    <!-- Submit -->
                    <div>
                        <button type="submit" class="cursor-pointer w-full py-3 rounded-lg bg-linear-to-r from-primary-500 to-accent shadow font-semibold hover:brightness-105 transition">
                            Create account
                        </button>
                    </div>

                    <p class="text-center text-sm text-slate-500">Already have an account?
                        <a href="/login" class="text-primary-700 font-medium">Sign in</a>
                    </p>
                </form>
            </section>
        </div> <!-- Minimal inline script inside body to validate & toggle -->
        <script>
            (function () {
                const form = document.getElementById('registerForm');
                const phone = document.getElementById('phone');
                const nameEl = document.getElementById('name');
                const email = document.getElementById('email');
                const pw = document.getElementById('password');
                const pwc = document.getElementById('password_confirmation');
                const phoneErr = document.getElementById('phoneErr');
                const nameErr = document.getElementById('nameErr');
                const emailErr = document.getElementById('emailErr');
                const pwErr = document.getElementById('pwErr');
                const pwMatchErr = document.getElementById('pwMatchErr');
                // Toggle password visibility 
                const toggle = document.getElementById('togglePw');
                const eyeOpen = document.getElementById('eyeOpen');
                const eyeClosed = document.getElementById('eyeClosed');
                toggle.addEventListener('click', () => {
                    const isHidden = pw.type === 'password';
                    pw.type = isHidden ? 'text' : 'password';
                    pwc.type = isHidden ? 'text' : 'password';
                    eyeOpen.classList.toggle('hidden', !isHidden);
                    eyeClosed.classList.toggle('hidden', isHidden);
                });
                // Simple validators 
                function validPhone(v) { v = (v || '').trim(); return /\+?\d[\d\s\-]{6,}$/.test(v); }
                function validEmail(v) { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test((v || '').trim()); }
                function clearErrors() {
                    [phoneErr, nameErr, emailErr, pwErr, pwMatchErr].forEach(el => el.classList.add('hidden'));
                }
                form.addEventListener('submit', (e) => {
                    e.preventDefault();
                    clearErrors();
                    let ok = true;
                    if (!validPhone(phone.value)) { phoneErr.classList.remove('hidden'); ok = false; }
                    if (!nameEl.value.trim()) { nameErr.classList.remove('hidden'); ok = false; }
                    if (!validEmail(email.value)) { emailErr.classList.remove('hidden'); ok = false; }
                    if (!pw.value || pw.value.length < 6) { pwErr.classList.remove('hidden'); ok = false; }
                    if (pw.value !== pwc.value) { pwMatchErr.classList.remove('hidden'); ok = false; }
                    if (!ok) return;
                    // Replace with real submit to backend (e.g. fetch POST /api/register) 
                    const payload = { phone: phone.value.trim(), name: nameEl.value.trim(), email: email.value.trim(), password: pw.value };
                    // visual feedback 
                    const btn = form.querySelector('button[type="submit"]');
                    btn.disabled = true;
                    btn.textContent = 'Creating account...';
                    form.submit()
                });
            })(); 
        </script>
    </main>
@endsection