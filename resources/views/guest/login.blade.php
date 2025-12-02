@extends('layout.guest')

@section('content')

    <style>
        .accent-gradient {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 45%, #06b6d4 100%);
        }

        .input-focus {
            box-shadow: 0 6px 18px rgba(124, 58, 237, 0.12);
        }
    </style>

    <main class="w-full max-w-4xl mx-auto pt-25 pb-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
            <!-- Left / Hero -->
            <section class="hidden lg:flex flex-col items-start gap-6">
                <div class="w-full rounded-2xl overflow-hidden shadow-soft">
                    <div class="h-72 object-cover w-full bg-[url('https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=1400&auto=format&fit=crop')] bg-center bg-cover"></div>
                </div>
                <div class="bg-white/90 p-4 rounded-xl glass shadow">
                    <h2 class="text-2xl font-extrabold text-slate-800">Welcome back!</h2>
                    <p class="text-slate-600 mt-2">Login to manage your listings, message neighbours and join local classes. New here? Create an account in seconds.</p>
                    <ul class="mt-3 text-sm text-slate-500 space-y-2">
                        <li>• Post skills & services</li>
                        <li>• Discover nearby help</li>
                        <li>• Secure and neighbourhood-first</li>
                    </ul>
                </div>
            </section>

            <!-- Right / Form Card -->
            <section class="bg-white rounded-2xl shadow-soft p-6 glass border border-white/60">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-800">Sign in to Knowledge Nest</h1>
                        <p class="text-sm text-slate-500 mt-1">Use your account or continue with social login</p>
                    </div>
                </div>

                <!-- Social buttons -->
                <div class="grid grid-cols-1 gap-3 mb-4">
                    <button class="flex items-center justify-center gap-2 px-4 py-2 rounded-lg border text-sm hover:shadow-md transition">
                        <img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/google.svg" alt="G" class="w-4 h-4" />
                        Continue with Google
                    </button>
                </div>

                <div class="flex items-center gap-3 mb-4">
                    <div class="h-px bg-slate-200 flex-1"></div>
                    <div class="text-xs text-slate-400">or</div>
                    <div class="h-px bg-slate-200 flex-1"></div>
                </div>

                <!-- form -->
                <form id="loginForm" class="space-y-4" action="{{ route('login.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-2" for="email">Email or phone</label>
                        <div class="relative">
                            <input id="email" name="email" type="text" required placeholder="you@neighbourhood.com" class="w-full rounded-lg border border-slate-200 px-4 py-3 text-sm focus:outline-none focus:ring-0 focus:border-transparent input-focus" />
                            <span class="absolute right-3 top-3 text-slate-400 text-xs">@</span>
                        </div>
                        <p id="emailErr" class="text-xs text-rose-500 mt-1 hidden">Please enter a valid email or phone.</p>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-slate-600 mb-2" for="password">Password</label>
                        <div class="relative">
                            <input id="password" name="password" type="password" minlength="6" required placeholder="••••••••" class="w-full rounded-lg border border-slate-200 px-4 py-3 text-sm focus:outline-none focus:ring-0 focus:border-transparent input-focus" />
                            <button type="button" id="passToggle" class="absolute right-2 top-2.5 text-slate-500 p-1 rounded hover:bg-slate-50">
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
                        <p id="passErr" class="text-xs text-rose-500 mt-1 hidden">Password must be at least 6 characters.</p>
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="inline-flex items-center gap-2 text-sm text-slate-600">
                            <input id="remember" type="checkbox" class="w-4 h-4 text-primary-600 rounded border-slate-300" />
                            <span>Remember me</span>
                        </label>
                        <a href="#" class="text-sm text-primary-700 font-medium">Forgot?</a>
                    </div>

                    <div>
                        <button id="submitBtn" type="submit" class="w-full py-3 rounded-lg text-white accent-gradient shadow hover:brightness-105 transition font-semibold">Sign in</button>
                    </div>

                    <p class="text-center text-sm text-slate-500">Don't have an account? <a href="{{ route('register.index') }}" class="text-primary-700 font-medium">Create one</a></p>
                </form>
            </section>
        </div>
    </main>

    <!-- Script -->
    <script>
        // minimal interactivity: toggle password visibility, simple client validation
        (function () {
            const pass = document.getElementById('password');
            const toggle = document.getElementById('passToggle');
            const eyeOpen = document.getElementById('eyeOpen');
            const eyeClosed = document.getElementById('eyeClosed');

            toggle.addEventListener('click', () => {
                const is = pass.type === 'password';
                pass.type = is ? 'text' : 'password';
                eyeOpen.classList.toggle('hidden', !is);
                eyeClosed.classList.toggle('hidden', is);
            });

            const form = document.getElementById('loginForm');
            const email = document.getElementById('email');
            const emailErr = document.getElementById('emailErr');
            const passErr = document.getElementById('passErr');

            function validEmailOrPhone(v) {
                v = (v || '').trim();
                if (!v) return false;
                const emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                const phoneRe = /^\+?\d[\d\s\-]{6,}$/;
                return emailRe.test(v) || phoneRe.test(v);
            }

            form.addEventListener('submit', (e) => {
                e.preventDefault();
                let ok = true;
                if (!validEmailOrPhone(email.value)) { emailErr.classList.remove('hidden'); ok = false; } else { emailErr.classList.add('hidden'); }
                if (!pass.value || pass.value.length < 6) { passErr.classList.remove('hidden'); ok = false; } else { passErr.classList.add('hidden'); }

                if (!ok) return;

                // placeholder: replace with real submit (AJAX / form action)
                document.getElementById('submitBtn').disabled = true;
                document.getElementById('submitBtn').innerHTML = 'Signing in...';
                document.getElementById('submitBtn').disabled = false;
                document.getElementById('submitBtn').innerHTML = 'Sign in';
                form.submit();
            });

            // small UX: add input focus outline class
            [email, pass].forEach(inp => {
                inp.addEventListener('focus', () => inp.classList.add('input-focus'));
                inp.addEventListener('blur', () => inp.classList.remove('input-focus'));
            });
        }());
    </script>
@endsection