@extends('layout.guest')

@section('content')
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-12">

        <!-- Hero Section -->
        <div class="relative bg-brand-900 rounded-4xl p-8 md:p-16 overflow-hidden mb-16 animate-fade-in text-center md:text-left">
            <!-- Abstract Background -->
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-brand-500/30 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-indigo-600/30 rounded-full blur-3xl"></div>

            <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-brand-100 text-xs font-semibold backdrop-blur-md mb-6 border border-white/10">
                        <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                        Our Mission
                    </div>
                    <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight leading-[1.1] mb-6">
                        Connecting Neighborhoods,<br>
                        <span class="text-transparent bg-clip-text bg-linear-to-r from-indigo-300 to-indigo-700">One Skill at a Time.</span>
                    </h1>
                    <p class="text-brand-100 text-lg mb-8 leading-relaxed max-w-xl">
                        KnowledgeNest is more than just a marketplace—it's a movement to bring communities closer together through the exchange of talents, hobbies, and local services.
                    </p>
                </div>
                <div class="hidden md:block relative">
                    <!-- Visual Collage using Tailwind -->
                    <div class="grid grid-cols-2 gap-4">
                        <img src="{{ asset('images/aboutus/pic1.jpg') }}" class="rounded-2xl shadow-lg transform translate-y-4" alt="Friends laughing">
                        <img src="{{ asset('images/aboutus/pic2.jpg') }}" class="rounded-2xl shadow-lg transform -translate-y-4" alt="Working together">
                    </div>
                </div>
            </div>
        </div>

        <!-- About The System Section -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-20 items-center">
            <div class="md:col-span-5 order-2 md:order-1">
                <div class="bg-white p-2 rounded-3xl shadow-xl rotate-2 hover:rotate-0 transition duration-500">
                    <img src="{{ asset('images/aboutus/pic3.jpg') }}" alt="Community Meeting" class="rounded-2xl w-full h-auto object-cover">
                </div>
            </div>
            <div class="md:col-span-7 order-1 md:order-2">
                <h2 class="text-3xl font-bold text-slate-900 mb-6">What is KnowledgeNest?</h2>
                <div class="space-y-4 text-slate-600 text-lg leading-relaxed">
                    <p>
                        In a digital world that often feels disconnected, KnowledgeNest brings the focus back to your local community. We believe that everyone has something valuable to teach, and everyone has something new to learn.
                    </p>
                    <p>
                        Whether you're a retired teacher offering math tutoring, a baker trading fresh sourdough for guitar lessons, or a tech whiz helping neighbors with computer repairs, KnowledgeNest provides the platform to make those connections happen locally and safely.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mt-8">
                    <div class="bg-indigo-50 p-4 rounded-2xl border border-indigo-100">
                        <div class="text-2xl mb-2">🤝</div>
                        <h4 class="font-bold text-indigo-900">Trust System</h4>
                        <p class="text-sm text-indigo-700">Verified neighbors and review system.</p>
                    </div>
                    <div class="bg-brand-50 p-4 rounded-2xl border border-brand-100">
                        <div class="text-2xl mb-2">📍</div>
                        <h4 class="font-bold text-brand-900">Hyper-Local</h4>
                        <p class="text-sm text-brand-700">Find skills right around the corner.</p>
                    </div>
                    <div class="bg-amber-50 p-4 rounded-2xl border border-amber-100">
                        <div class="text-2xl mb-2">💡</div>
                        <h4 class="font-bold text-amber-900">Skill Growth</h4>
                        <p class="text-sm text-amber-700">Learn new hobbies or monetize talents.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- How It Works (Visualization) -->
        <div class="bg-white rounded-4xl p-8 md:p-16 shadow-card border border-slate-100 mb-16 relative overflow-hidden">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-3xl font-bold text-slate-900 mb-4">How It Works</h2>
                <p class="text-slate-500 text-lg">Getting started is simple. Join your neighborhood network in minutes.</p>
            </div>

            <div class="relative grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Connecting Line (Desktop) -->
                <div class="hidden md:block absolute top-12 left-0 w-full h-0.5 bg-slate-100 -z-10"></div>

                <!-- Step 1 -->
                <div class="relative group">
                    <div class="w-24 h-24 mx-auto bg-white rounded-full border-4 border-brand-100 flex items-center justify-center mb-6 shadow-sm group-hover:scale-110 transition duration-300 z-10 relative">
                        <span class="text-4xl">📝</span>
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-brand-500 rounded-full text-white flex items-center justify-center font-bold">1</div>
                    </div>
                    <div class="text-center px-4">
                        <h3 class="font-bold text-xl text-slate-800 mb-2">Create Your Profile</h3>
                        <p class="text-slate-500">Sign up and list the skills you can offer or the services you need.</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="relative group">
                    <div class="w-24 h-24 mx-auto bg-white rounded-full border-4 border-indigo-100 flex items-center justify-center mb-6 shadow-sm group-hover:scale-110 transition duration-300 z-10 relative">
                        <span class="text-4xl">🔍</span>
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-indigo-500 rounded-full text-white flex items-center justify-center font-bold">2</div>
                    </div>
                    <div class="text-center px-4">
                        <h3 class="font-bold text-xl text-slate-800 mb-2">Discover & Connect</h3>
                        <p class="text-slate-500">Browse listings in your area and chat with neighbors to arrange a session.</p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="relative group">
                    <div class="w-24 h-24 mx-auto bg-white rounded-full border-4 border-green-100 flex items-center justify-center mb-6 shadow-sm group-hover:scale-110 transition duration-300 z-10 relative">
                        <span class="text-4xl">🚀</span>
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-green-500 rounded-full text-white flex items-center justify-center font-bold">3</div>
                    </div>
                    <div class="text-center px-4">
                        <h3 class="font-bold text-xl text-slate-800 mb-2">Learn & Grow</h3>
                        <p class="text-slate-500">Meet up, exchange skills, and build your reputation in the community.</p>
                    </div>
                </div>
            </div>

            <div class="mt-16 text-center">
                <a href="{{ route('register.index') }}" class="inline-flex items-center gap-2 bg-brand-900 px-8 py-4 rounded-full font-bold hover:bg-brand-800 transition shadow-xl shadow-brand-900/20 hover:scale-105 duration-200">
                    Join the Community
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>

    </main>
@endsection