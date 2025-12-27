@props(['post'])

{{-- Floating Chat Button + Window --}}
<div x-data="chatWidget({{ $post->id }})" x-cloak class="fixed bottom-6 right-6 z-50">
    <!-- Toggle Button -->
    <button @click="open = !open" :aria-expanded="open" class="group inline-flex items-center gap-3 px-4 py-2 rounded-full bg-white shadow-lg hover:shadow-xl transition">
        <div class="w-9 h-9 rounded-full bg-linear-to-br from-indigo-500 via-purple-600 to-rose-500 flex items-center justify-center text-white font-bold">
            AI
        </div>
        <div class="hidden sm:block text-sm font-medium text-slate-800">Assistant</div>
        <svg :class="{'rotate-180': open}" class="w-4 h-4 text-slate-500 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>

    <!-- Chat Window -->
    <div x-show="open" x-transition class="mt-3 w-80 sm:w-96 max-h-[70vh] bg-linear-to-br from-slate-900/90 to-indigo-900/95 text-white rounded-2xl shadow-2xl ring-1 ring-white/10 overflow-hidden">
        <header class="flex items-center justify-between px-4 py-3">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-linear-to-br from-indigo-500 via-purple-600 to-rose-500 flex items-center justify-center font-semibold">AI</div>
                <div>
                    <div class="text-sm font-semibold">Assistant</div>
                    <div class="text-xs text-slate-200/80">Context: This Post</div>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <button @click="clear()" title="Clear" class="text-slate-200/80 hover:text-white p-1 rounded-md text-xs uppercase tracking-wider font-semibold">
                    Clear
                </button>
                <button @click="open=false" title="Close" class="text-slate-200/80 hover:text-white p-1 rounded-md">✕</button>
            </div>
        </header>

        <!-- messages area -->
        <div class="px-3 py-2 overflow-auto scrollbar-thin scrollbar-thumb-slate-700 scrollbar-track-transparent" style="max-height:48vh" x-ref="panel">
            <div class="text-[10px] text-center text-slate-400 mb-4 font-mono uppercase tracking-widest opacity-50">
                — Start of post-specific conversation —
            </div>
            <template x-for="(m, idx) in messages" :key="idx">
                <div class="mb-3">
                    <div x-show="m.role === 'user'" class="flex justify-end">
                        <div class="max-w-[85%] bg-white text-slate-900 px-3 py-2 rounded-2xl rounded-br-none text-sm shadow-sm">
                            <div x-text="m.content" class="whitespace-pre-wrap"></div>
                        </div>
                    </div>
                    <div x-show="m.role !== 'user'" class="flex justify-start">
                        <div class="max-w-[85%] bg-slate-800/80 border border-white/5 px-3 py-2 rounded-2xl rounded-bl-none text-sm">
                            <div x-text="m.content" class="whitespace-pre-wrap leading-relaxed"></div>
                        </div>
                    </div>
                </div>
            </template>

            <!-- loading indicator -->
            <div x-show="loading" class="flex items-center gap-2 text-sm text-indigo-300 py-2 animate-pulse">
                <div class="flex gap-1">
                    <span class="w-1.5 h-1.5 bg-indigo-400 rounded-full animate-bounce"></span>
                    <span class="w-1.5 h-1.5 bg-indigo-400 rounded-full animate-bounce [animation-delay:-0.15s]"></span>
                    <span class="w-1.5 h-1.5 bg-indigo-400 rounded-full animate-bounce [animation-delay:-0.3s]"></span>
                </div>
                <div class="text-xs font-semibold uppercase tracking-wider">AI is thinking...</div>
            </div>
        </div>

        <!-- form -->
        <form @submit.prevent="send()" class="px-3 py-3 bg-white/5 border-t border-white/10">
            <div class="flex gap-2">
                <textarea x-model="input" placeholder="Ask about this post..." rows="1" class="flex-1 resize-none bg-slate-800/50 border border-white/10 rounded-xl px-3 py-2 text-sm text-white placeholder:text-slate-500 focus:outline-none focus:ring-1 focus:ring-indigo-500/50" @keydown.enter.prevent.shift="sendOnEnter($event)" :disabled="loading"></textarea>
                <button type="submit" :disabled="loading || !input.trim()" class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-indigo-500 hover:bg-indigo-600 disabled:opacity-50 disabled:cursor-not-allowed text-white shadow-lg transition-all active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </button>
            </div>
            <div class="mt-2 flex justify-between items-center text-[10px] text-slate-400 px-1">
                <span>Enter to send • Shift+Enter for new line</span>
                <span x-text="input.length + '/1000'"></span>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('chatWidget', (postId) => ({
            open: false,
            input: '',
            messages: [],
            loading: false,
            postId: postId,

            init() {
                // We don't load history on init anymore to keep it strictly ephemeral to the current session interactions
                // but if we wanted to sync with server session, we'd do a fetch here.
            },

            scrollToBottom() {
                this.$nextTick(() => {
                    const panel = this.$refs.panel;
                    if (panel) panel.scrollTo({ top: panel.scrollHeight, behavior: 'smooth' });
                });
            },

            sendOnEnter(e) {
                if (!e.shiftKey) {
                    e.preventDefault();
                    this.send();
                }
            },

            async clear() {
                if (!confirm('Clear this chat history?')) return;
                this.messages = [];
                // Optional: call server to clear session
                await fetch('/chat/clear', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ post_id: this.postId })
                });
            },

            async send() {
                const content = this.input && this.input.trim();
                if (!content || this.loading) return;

                // 1. Show user message immediately
                this.messages.push({ role: 'user', content });
                this.input = '';

                // 2. SHOW LOADING IMMEDIATELY
                this.loading = true;
                this.scrollToBottom();

                try {
                    const res = await fetch('/chat', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            post_id: this.postId,
                            message: content
                        })
                    });

                    if (!res.ok) {
                        const errData = await res.json();
                        throw new Error(errData.error || 'Server error');
                    }

                    const data = await res.json();

                    if (data.status === 'success') {
                        this.messages.push({ role: 'assistant', content: data.message });
                    }

                } catch (err) {
                    this.messages.push({
                        role: 'assistant',
                        content: '⚠️ Error: ' + (err.message || 'Unable to reach AI assistant.')
                    });
                } finally {
                    this.loading = false;
                    this.scrollToBottom();
                }
            }
        }));
    });
</script>