@extends('layout.guest')

@section('content')
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-12">

        <!-- Hero Section -->
        <div class="relative bg-indigo-900 rounded-4xl p-8 md:p-16 overflow-hidden mb-16 animate-fade-in text-center md:text-left">
            <!-- Abstract Background -->
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-indigo-500/30 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-brand-600/30 rounded-full blur-3xl"></div>

            <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-indigo-100 text-xs font-semibold backdrop-blur-md mb-6 border border-white/10">
                        <span class="w-2 h-2 rounded-full bg-pink-400 animate-pulse"></span>
                        Join the Movement
                    </div>
                    <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-[1.1] mb-6">
                        Unlock the Potential of<br>
                        <span class="text-transparent bg-clip-text bg-linear-to-r from-brand-400 to-indigo-400">Your Neighborhood.</span>
                    </h1>
                    <p class="text-indigo-100 text-lg mb-8 leading-relaxed max-w-xl">
                        Discover a world of skills right next door. From learning to earning, KnowledgeNest connects you with the people who make your community unique.
                    </p>
                    <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                        <a href="{{ route('register.index') }}" class="bg-white text-indigo-900 px-8 py-3.5 rounded-full font-bold hover:bg-indigo-50 transition shadow-xl shadow-indigo-900/20 flex items-center gap-2 group hover:scale-105 duration-200">
                            Get Started Free
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="hidden md:block relative">
                    <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=800&fit=crop" class="rounded-3xl shadow-2xl rotate-3 hover:rotate-0 transition duration-500 border-4 border-white/10" alt="Group of people planning">
                </div>
            </div>
        </div>

        <!-- Main Value Proposition Grid -->
        <div class="mb-20">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl font-bold text-slate-900 mb-4">Why Members Love KnowledgeNest</h2>
                <p class="text-slate-500 text-lg">We're building a community where everyone wins—sharing skills, saving money, and making friends.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Benefit 1 -->
                <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-card hover:shadow-card-hover transition duration-300 group">
                    <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 mb-6 group-hover:scale-110 transition duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Earn Extra Income</h3>
                    <p class="text-slate-500 leading-relaxed">Turn your hobbies into a side hustle. Whether it's guitar lessons, gardening help, or baking, there's a neighbor willing to pay for your skills.</p>
                </div>

                <!-- Benefit 2 -->
                <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-card hover:shadow-card-hover transition duration-300 group">
                    <div class="w-14 h-14 bg-brand-50 rounded-2xl flex items-center justify-center text-brand-600 mb-6 group-hover:scale-110 transition duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Learn Something New</h3>
                    <p class="text-slate-500 leading-relaxed">Always wanted to learn French? Need help fixing a leaky faucet? Find local experts who can teach you or help you out.</p>
                </div>

                <!-- Benefit 3 -->
                <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-card hover:shadow-card-hover transition duration-300 group">
                    <div class="w-14 h-14 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 mb-6 group-hover:scale-110 transition duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Build Community</h3>
                    <p class="text-slate-500 leading-relaxed">Connect with people you might never have met otherwise. Strengthen the fabric of your local neighborhood through trusted interactions.</p>
                </div>

                <!-- Benefit 4 -->
                <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-card hover:shadow-card-hover transition duration-300 group">
                    <div class="w-14 h-14 bg-green-50 rounded-2xl flex items-center justify-center text-green-600 mb-6 group-hover:scale-110 transition duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Verified & Safe</h3>
                    <p class="text-slate-500 leading-relaxed">Our ID verification and community review system ensures you know exactly who you're dealing with. Safety is our priority.</p>
                </div>

                <!-- Benefit 5 -->
                <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-card hover:shadow-card-hover transition duration-300 group">
                    <div class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 mb-6 group-hover:scale-110 transition duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Support Local</h3>
                    <p class="text-slate-500 leading-relaxed">Keep resources within your community. By hiring a neighbor, you're directly supporting the local economy and reducing carbon footprint.</p>
                </div>

                <!-- Benefit 6 -->
                <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-card hover:shadow-card-hover transition duration-300 group">
                    <div class="w-14 h-14 bg-pink-50 rounded-2xl flex items-center justify-center text-pink-600 mb-6 group-hover:scale-110 transition duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Flexible & Fun</h3>
                    <p class="text-slate-500 leading-relaxed">Set your own schedule, choose your own rates, and meet interesting people. It's the most flexible way to work and play.</p>
                </div>
            </div>
        </div>

        <!-- Testimonial Section -->
        <div class="relative bg-slate-900 rounded-3xl p-8 md:p-12 text-center overflow-hidden">
            <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
            <div class="relative z-10 max-w-2xl mx-auto">
                <svg class="w-12 h-12 text-white/20 mx-auto mb-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M14.017 21L14.017 18C14.017 16.8954 13.1216 16 12.017 16H9C9 16 9 16 9 11C9 8.00001 11.0294 5.92893 13.0607 4.90803L14.0303 4.42065L12.9697 2.57934L12 3C8.5 4.5 5 8 5 12V21H14.017ZM23.017 21L23.017 18C23.017 16.8954 22.1216 16 21.017 16H18C18 16 18 16 18 11C18 8.00001 20.0294 5.92893 22.0607 4.90803L23.0303 4.42065L21.9697 2.57934L21 3C17.5 4.5 14 8 14 12V21H23.017Z" />
                </svg>
                <h3 class="text-2xl font-medium text-white mb-6">"KnowledgeNest completely changed how I see my neighborhood. I've met three neighbors who play board games, and I found someone to walk my dog when I'm late for work. It's a game changer."</h3>
                <div class="flex items-center justify-center gap-3">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop" class="w-12 h-12 rounded-full border-2 border-brand-500" alt="Sarah J.">
                    <div class="text-left">
                        <div class="text-white font-bold">Michael T.</div>
                        <div class="text-slate-400 text-sm">Joined 2 months ago</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Final CTA -->
        <div class="text-center mt-20 mb-12">
            <h2 class="text-3xl font-bold text-slate-900 mb-6">Ready to Join Your Neighborhood?</h2>
            <a href="{{ route('register.index') }}" class="inline-flex items-center gap-2 bg-brand-600 px-10 py-4 rounded-full font-bold text-lg hover:bg-brand-700 transition shadow-lg hover:shadow-xl hover:scale-105 duration-200">
                Create Your Free Account
            </a>
            <p class="mt-4 text-slate-500 text-sm">No credit card required. Takes less than 2 minutes.</p>
        </div>

    </main>
@endsection