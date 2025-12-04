@extends('layout.guest')

@section('content')
    <style>
        <style>

        /* Custom Overrides for EasyMDE to match Tailwind UI */
        .EasyMDEContainer .CodeMirror {
            border-bottom-left-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
            border-color: #e2e8f0;
            /* slate-200 */
            border-top: 0;
            padding: 1rem;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-size: 0.875rem;
            color: #334155;
        }

        .EasyMDEContainer .CodeMirror-focused {
            border-color: #6366f1;
            /* indigo-500 */
            box-shadow: 0 0 0 1px #6366f1;
        }

        /* Tagify Customization */
        .tagify {
            --tags-border-color: #e2e8f0;
            --tags-focus-border-color: #6366f1;
            --tag-bg: #f1f5f9;
            --tag-hover: #e2e8f0;
            border-radius: 0.5rem;
            padding: 0.5rem;
        }

        /* Glass effect class */
        .glass-panel {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
    </style>
    <main class="min-h-screen sm:px-6 lg:px-8 bg-linear-to-b from-indigo-50/50 to-white pt-16 pb-20">
        <div class="max-w-6xl mx-auto pt-10">

            <div class="mb-8 md:flex md:items-center md:justify-between">
                <div class="min-w-0 flex-1">
                    <h2 class="text-3xl font-bold leading-7 text-slate-900 sm:truncate sm:text-4xl sm:tracking-tight pb-3">
                        Create new listing
                    </h2>
                    <p class="text-slate-500">
                        Share your knowledge or offer a service to the neighborhood.
                    </p>
                </div>
                <div class="mt-4 flex md:ml-4 md:mt-0">
                    <a href="/" class="text-sm font-medium text-slate-600 hover:text-slate-900">Back</a>
                </div>
            </div>
            @if ($errors->any())
                <div class="mb-8 rounded-xl bg-red-50 border border-red-200 p-4">
                    <div class="flex">
                        <div class="shrink-0">
                            <i class="fa-solid fa-circle-exclamation text-red-500"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul role="list" class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif


            <form id="postForm" class="space-y-8" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-6">
                        <div class="glass-panel shadow-xl shadow-slate-200/60 rounded-2xl border border-white p-6 sm:p-8">
                            <div class="mb-6">
                                <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Post Title <span class="text-rose-500">*</span></label>
                                <input id="title" name="title" type="text" required placeholder="e.g. How to fix a leaky faucet" class="block w-full rounded-xl border-0 py-3.5 px-4 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-200 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-lg sm:leading-6 transition-all duration-200" />
                            </div>

                            <div class="mb-6">
                                <label for="brief_description" class="block text-sm font-semibold text-slate-700 mb-2">Brief Description</label>
                                <textarea id="brief_description" name="brief_description" rows="2" class="block w-full rounded-xl border-0 py-3.5 px-4 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-200 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition-all duration-200" placeholder="A short summary of your post..."></textarea>
                            </div>
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <label class="block text-sm font-semibold text-slate-700">Content <span class="text-rose-500">*</span></label>
                                    <span class="text-xs text-slate-400 bg-slate-100 px-2 py-1 rounded-full">Markdown Enabled</span>
                                </div>

                                <div class="flex flex-wrap items-center gap-1 bg-slate-50 border border-slate-200 rounded-t-lg p-2 border-b-0">
                                    <button type="button" data-md-action="bold" class="p-2 text-slate-600 hover:text-indigo-600 hover:bg-white hover:shadow-sm rounded transition-all" title="Bold">
                                        <i class="fa-solid fa-bold"></i>
                                    </button>
                                    <button type="button" data-md-action="italic" class="p-2 text-slate-600 hover:text-indigo-600 hover:bg-white hover:shadow-sm rounded transition-all" title="Italic">
                                        <i class="fa-solid fa-italic"></i>
                                    </button>
                                    <div class="w-px h-4 bg-slate-300 mx-1"></div>
                                    <button type="button" data-md-action="h2" class="p-2 text-slate-600 hover:text-indigo-600 hover:bg-white hover:shadow-sm rounded transition-all" title="Heading">
                                        <i class="fa-solid fa-heading"></i>
                                    </button>
                                    <button type="button" data-md-action="quote" class="p-2 text-slate-600 hover:text-indigo-600 hover:bg-white hover:shadow-sm rounded transition-all" title="Quote">
                                        <i class="fa-solid fa-quote-right"></i>
                                    </button>
                                    <button type="button" data-md-action="link" class="p-2 text-slate-600 hover:text-indigo-600 hover:bg-white hover:shadow-sm rounded transition-all" title="Link">
                                        <i class="fa-solid fa-link"></i>
                                    </button>
                                    <div class="w-px h-4 bg-slate-300 mx-1"></div>
                                    <button type="button" data-md-action="list-ul" class="p-2 text-slate-600 hover:text-indigo-600 hover:bg-white hover:shadow-sm rounded transition-all" title="Bullet List">
                                        <i class="fa-solid fa-list-ul"></i>
                                    </button>

                                    <div class="flex-1"></div>

                                    <button type="button" id="mdPreviewToggle" class="hidden md:flex items-center gap-2 px-3 py-1.5 text-xs font-medium text-slate-600 bg-white border border-slate-200 rounded shadow-sm hover:bg-slate-50">
                                        <i class="fa-regular fa-eye"></i> <span>Toggle Preview</span>
                                    </button>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 group relative">
                                    <div id="editorContainer" class="col-span-1 md:col-span-2 transition-all duration-300">
                                        <textarea id="mdEditor" name="markdown" class="hidden"></textarea>
                                    </div>

                                    <div id="mdPreview" class="hidden border-l border-slate-200 bg-slate-50/50 p-6 h-[400px] overflow-y-auto prose prose-sm prose-slate max-w-none">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">

                        <div class="glass-panel shadow-lg shadow-slate-200/50 rounded-2xl border border-white p-6">

                            <div class="mb-6">
                                <label for="tags" class="block text-sm font-semibold text-slate-700 mb-2">Topic Tags</label>
                                <input id="tags" name="tags" placeholder="Add tags..." value="Help, DIY" class="w-full text-sm" />
                                <p class="text-xs text-slate-400 mt-2">Press enter after each tag.</p>
                            </div>

                            <div class="mb-6">
                                <div class="flex items-center justify-between mb-2">
                                    <label for="difficulty" class="block text-sm font-semibold text-slate-700">Difficulty Level</label>
                                    <span id="difficultyLabel" class="text-xs font-medium text-indigo-600 bg-indigo-50 px-2 py-1 rounded-full">Beginner</span>
                                </div>
                                <input type="range" id="difficulty" name="difficulty" min="1" max="3" value="1" class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-indigo-600">
                                <div class="flex justify-between text-xs text-slate-400 mt-1 px-1">
                                    <span>Easy</span>
                                    <span>Hard</span>
                                </div>
                            </div>

                            <div class="mb-6">
                                <label for="thumbnail" class="block text-sm font-semibold text-slate-700 mb-2">Thumbnail</label>
                                <input id="thumbnail" name="thumbnail" type="file" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all" />
                            </div>

                            <hr class="border-slate-100 my-6">

                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="flex h-6 items-center">
                                        <input id="allowComments" name="allowComments" type="checkbox" checked class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-600">
                                    </div>
                                    <div class="ml-3 text-sm leading-6">
                                        <label for="allowComments" class="font-medium text-slate-900">Allow comments</label>
                                        <p class="text-slate-500">Neighbors can discuss this post.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 pt-6 border-t border-slate-100 flex flex-col gap-3">
                                <button type="submit" class="w-full rounded-xl bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all">
                                    Publish Post
                                </button>
                                <button type="button" id="cancelBtn" class="w-full rounded-xl bg-white px-3.5 py-2.5 text-sm font-semibold text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50">
                                    Cancel
                                </button>
                            </div>

                        </div>

                        <div class="rounded-xl bg-blue-50 p-4 border border-blue-100">
                            <div class="flex">
                                <div class="shrink-0">
                                    <i class="fa-solid fa-circle-info text-blue-400"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-blue-800">Pro Tip</h3>
                                    <div class="mt-2 text-sm text-blue-700">
                                        <p>Use clear headings to break up your content. Neighbors love step-by-step guides!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </main>
    <script>
        window.onload = function () {
            (function () {
                // Storage Keys
                const STORAGE_KEYS = {
                    TITLE: 'newpost_title',
                    BRIEF: 'newpost_brief',
                    CONTENT: 'newpost_content',
                    TAGS: 'newpost_tags',
                    DIFFICULTY: 'newpost_difficulty',
                    ALLOW_COMMENTS: 'newpost_allow_comments'
                };

                // 1. Initialize EasyMDE
                const easy = new EasyMDE({
                    element: document.getElementById('mdEditor'),
                    autoDownloadFontAwesome: false,
                    spellChecker: false,
                    toolbar: false,
                    status: false,
                    minHeight: "400px",
                    placeholder: "Start typing your story here..."
                });

                // 2. Initialize Tagify
                const tagInput = document.getElementById('tags');
                const tagify = new Tagify(tagInput, {
                    whitelist: ['Woodworking', 'Gardening', 'Computer Repair', 'Cooking', 'Plumbing'],
                    dropdown: {
                        maxItems: 20,
                        classname: "tags-look",
                        enabled: 0,
                        closeOnSelect: false
                    }
                });

                // Load State from LocalStorage
                function loadState() {
                    const title = localStorage.getItem(STORAGE_KEYS.TITLE);
                    const brief = localStorage.getItem(STORAGE_KEYS.BRIEF);
                    const content = localStorage.getItem(STORAGE_KEYS.CONTENT);
                    const tags = localStorage.getItem(STORAGE_KEYS.TAGS);
                    const difficulty = localStorage.getItem(STORAGE_KEYS.DIFFICULTY);
                    const allowComments = localStorage.getItem(STORAGE_KEYS.ALLOW_COMMENTS);

                    if (title) document.getElementById('title').value = title;
                    if (brief) document.getElementById('brief_description').value = brief;
                    if (content) easy.value(content);

                    if (tags) {
                        try {
                            tagify.removeAllTags();
                            tagify.addTags(JSON.parse(tags));
                        } catch (e) {
                            console.error("Error parsing tags from storage", e);
                        }
                    }

                    if (difficulty) {
                        document.getElementById('difficulty').value = difficulty;
                        // Trigger input event to update label
                        document.getElementById('difficulty').dispatchEvent(new Event('input'));
                    }

                    if (allowComments !== null) {
                        document.getElementById('allowComments').checked = allowComments === 'true';
                    }
                }

                // Save State to LocalStorage
                function saveState() {
                    localStorage.setItem(STORAGE_KEYS.TITLE, document.getElementById('title').value);
                    localStorage.setItem(STORAGE_KEYS.BRIEF, document.getElementById('brief_description').value);
                    localStorage.setItem(STORAGE_KEYS.CONTENT, easy.value());
                    localStorage.setItem(STORAGE_KEYS.TAGS, JSON.stringify(tagify.value.map(t => t.value)));
                    localStorage.setItem(STORAGE_KEYS.DIFFICULTY, document.getElementById('difficulty').value);
                    localStorage.setItem(STORAGE_KEYS.ALLOW_COMMENTS, document.getElementById('allowComments').checked);
                }

                // Clear State
                function clearState() {
                    Object.values(STORAGE_KEYS).forEach(key => localStorage.removeItem(key));
                }

                // Initial Load
                loadState();

                // Attach Listeners for Saving
                document.getElementById('title').addEventListener('input', saveState);
                document.getElementById('brief_description').addEventListener('input', saveState);
                document.getElementById('difficulty').addEventListener('input', saveState);
                document.getElementById('allowComments').addEventListener('change', saveState);

                easy.codemirror.on('change', saveState);
                tagify.on('change', saveState);

                // 3. Preview Logic
                const previewPanel = document.getElementById('mdPreview');
                const editorContainer = document.getElementById('editorContainer');
                const toggleBtn = document.getElementById('mdPreviewToggle');
                let isPreviewOpen = false;

                function updatePreview() {
                    if (!isPreviewOpen) return;
                    const md = easy.value();
                    // Use marked to parse, handle empty state
                    previewPanel.innerHTML = md ? marked.parse(md) : '<p class="text-slate-400 italic">Preview area...</p>';
                }

                toggleBtn.addEventListener('click', () => {
                    isPreviewOpen = !isPreviewOpen;

                    if (isPreviewOpen) {
                        // Split Screen Mode
                        editorContainer.classList.remove('md:col-span-2');
                        editorContainer.classList.add('md:col-span-1');
                        previewPanel.classList.remove('hidden');
                        toggleBtn.classList.add('bg-indigo-50', 'text-indigo-700', 'border-indigo-200');
                        updatePreview();
                    } else {
                        // Full Width Mode
                        editorContainer.classList.add('md:col-span-2');
                        editorContainer.classList.remove('md:col-span-1');
                        previewPanel.classList.add('hidden');
                        toggleBtn.classList.remove('bg-indigo-50', 'text-indigo-700', 'border-indigo-200');
                    }

                    // Refresh CodeMirror layout so it knows it resized
                    setTimeout(() => easy.codemirror.refresh(), 300);
                });

                // Live update listener
                easy.codemirror.on('change', () => {
                    if (isPreviewOpen) setTimeout(updatePreview, 200);
                });

                // 4. Custom Toolbar Action Handler
                document.querySelectorAll('[data-md-action]').forEach(btn => {
                    btn.addEventListener('click', () => {
                        const action = btn.getAttribute('data-md-action');
                        const cm = easy.codemirror;
                        const selection = cm.getSelection();

                        cm.focus();

                        const wrappers = {
                            'bold': ['**', '**'],
                            'italic': ['*', '*'],
                            'quote': ['> ', ''],
                            'h2': ['## ', ''],
                            'list-ul': ['- ', ''],
                            'link': ['[', '](url)']
                        };

                        if (wrappers[action]) {
                            const [start, end] = wrappers[action];
                            cm.replaceSelection(`${start}${selection}${end}`);
                            // Adjust cursor for link
                            if (action === 'link') {
                                const pos = cm.getCursor();
                                cm.setCursor({ line: pos.line, ch: pos.ch - 1 });
                            }
                        }
                    });
                });

                const form = document.getElementById('postForm');

                // 5. Form Submission
                form.addEventListener('submit', (e) => {
                    e.preventDefault();

                    // Collect Data
                    const payload = {
                        title: document.getElementById('title').value,
                        content: easy.value(),
                        tags: tagify.value.map(t => t.value),
                        allowComments: document.getElementById('allowComments').checked,
                        brief_description: document.getElementById('brief_description').value,
                        difficulty: document.getElementById('difficulty').value,
                    };


                    // Validation Visuals
                    const submitBtn = e.target.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerText;

                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Publishing...';

                    console.log("Payload ready for Backend:", payload);
                    // Clear LocalStorage before submitting
                    clearState();
                    form.submit();
                });

            })();

            // Difficulty Slider Logic
            const difficultyInput = document.getElementById('difficulty');
            const difficultyLabel = document.getElementById('difficultyLabel');
            const difficultyLevels = {
                1: 'Easy',
                2: 'Medium',
                3: 'Hard',
            };

            if (difficultyInput && difficultyLabel) {
                difficultyInput.addEventListener('input', (e) => {
                    const val = e.target.value;
                    difficultyLabel.textContent = difficultyLevels[val] || 'Unknown';
                });
            }
        }
    </script>
@endsection