@extends('layouts.app')

@section('title', 'Add Book')
@section('hide_sidebar', true)
@section('hide_topbar', true)

@section('content')
{{-- Top bar (like provided UI) --}}
<header class="bg-white shadow-sm sticky top-0 z-20 -mx-6 lg:-mx-8 px-6 lg:px-8 py-4">
    <div class="flex items-center justify-between">

        <div class="flex items-start gap-4">
            <a href="{{ route('books.index') }}"
                class="mt-1 text-gray-500 hover:text-gray-800 transition"
                title="Back">
                {{-- back arrow --}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                    class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7 7-7" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18" />
                </svg>
            </a>

            <div>
                <h1 class="text-xl font-bold text-gray-900">Add Book</h1>
                <p class="text-sm text-gray-500">Add a new book to the collection</p>
            </div>
        </div>

        {{-- User dropdown (UI-only placeholder) --}}
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center text-white font-semibold">
                SM
            </div>
            <div class="hidden sm:block leading-tight">
                <div class="text-sm font-semibold text-gray-800">SM Kazal Mahmood</div>
                <div class="text-xs text-gray-500">kazalmahmood@gmail.com</div>
            </div>
            <svg class="w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7" />
            </svg>
        </div>
    </div>
</header>

{{-- Form Card --}}
<div class="max-w-5xl mx-auto mt-6">
    @if ($errors->any())
    <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700">
        <p class="font-semibold mb-2">Please fix the following errors:</p>
        <ul class="list-disc list-inside text-sm space-y-1">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-2"></div>

        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="p-6 space-y-8">

                {{-- Cover section --}}
                <div>
                    <h2 class="text-sm font-semibold text-gray-800 mb-4">Book Cover</h2>

                    <div class="grid grid-cols-1 md:grid-cols-[120px_1fr] gap-6 items-start">

                        {{-- preview box --}}
                        <div class="w-[120px] h-[160px] rounded-xl border border-gray-200 bg-gray-50 flex items-center justify-center overflow-hidden">
                            <img id="coverPreview" src="" alt=""
                                class="hidden w-full h-full object-cover" />
                            <div id="coverPlaceholder" class="text-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-10 h-10">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.25 2.25M3 19.5h18A2.25 2.25 0 0 0 23.25 17.25V6.75A2.25 2.25 0 0 0 21 4.5H3A2.25 2.25 0 0 0 .75 6.75v10.5A2.25 2.25 0 0 0 3 19.5Z" />
                                </svg>
                            </div>
                        </div>

                        {{-- dropzone --}}
                        <div>
                            <label for="coverInput" id="dropzone"
                                class="block w-full rounded-xl border-2 border-dashed border-gray-300 bg-white
                                    px-6 py-10 text-center cursor-pointer hover:bg-gray-50 transition">
                                <div class="flex flex-col items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="w-8 h-8 text-gray-400">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 16.5V7.5m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-.88-8.914 5.25 5.25 0 0 1 10.36-1.217 4.5 4.5 0 0 1 .77 8.131H6.75Z" />
                                    </svg>

                                    <div class="text-sm">
                                        <span class="text-indigo-600 font-semibold">Click to upload</span>
                                        <span class="text-gray-600">or drag and drop</span>
                                    </div>

                                    <div class="text-xs text-gray-500">PNG, JPG up to 2MB</div>
                                </div>
                            </label>

                            <input id="coverInput" type="file" name="cover_image" accept="image/*" class="hidden">

                            <div class="text-xs text-gray-500 mt-2">Recommended: 300×400px ratio</div>

                            @error('cover_image')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Fields --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Title --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Book Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" value="{{ old('title') }}"
                            placeholder="Enter book title"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-white
                                          focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @error('title')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ISBN --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            ISBN <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="isbn" value="{{ old('isbn') }}"
                            placeholder="978-..."
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-white
                                          focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @error('isbn')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Author --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Author <span class="text-red-500">*</span>
                        </label>
                        <select name="author_id"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-gray-100
                                           focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">Select author</option>
                            @foreach($authors as $author)
                            <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('author_id')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Category --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <select name="category_id"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-gray-100
                                           focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">Select category</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Published Date --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Published Date
                    </label>

                    <input type="date" name="published_at"
                        value="{{ old('published_at') }}"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-white
                  focus:outline-none focus:ring-2 focus:ring-indigo-500">

                    @error('published_at')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Description
                    </label>
                    <textarea name="description" rows="4"
                        placeholder="Enter book description"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-white
                                         focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description') }}</textarea>
                    @error('description')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status (UI matches provided; if you don't have DB column, it's UI-only) --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Status
                    </label>
                    <select name="status"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-gray-100
                                       focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="available" {{ old('status', 'available') === 'available' ? 'selected' : '' }}>Available</option>
                        <option value="borrowed" {{ old('status') === 'borrowed' ? 'selected' : '' }}>Borrowed</option>
                    </select>
                </div>

            </div>

            {{-- Bottom actions (right aligned like UI) --}}
            <div class="px-6 pb-6 flex justify-end gap-3">
                <a href="{{ route('books.index') }}"
                    class="px-6 py-3 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-50 transition">
                    Cancel
                </a>

                <button type="submit"
                    class="px-6 py-3 rounded-xl text-white font-semibold
                                   bg-gradient-to-r from-indigo-600 to-purple-600
                                   hover:from-indigo-700 hover:to-purple-700 transition shadow">
                    Add Book
                </button>
            </div>

        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const input = document.getElementById('coverInput');
    const preview = document.getElementById('coverPreview');
    const placeholder = document.getElementById('coverPlaceholder');
    const dropzone = document.getElementById('dropzone');

    function showPreview(file) {
        if (!file) return;

        // optional: validate file type
        if (!file.type.startsWith('image/')) {
            alert('Please select an image file.');
            return;
        }

        const url = URL.createObjectURL(file);
        preview.src = url;
        preview.classList.remove('hidden');
        placeholder.classList.add('hidden');
    }

    // Normal click-select preview
    input?.addEventListener('change', function() {
        const file = this.files && this.files[0];
        showPreview(file);
    });

    // Drag & drop support
    if (dropzone && input) {

        const activeClasses = ['bg-indigo-50', 'border-indigo-400'];

        function activate() {
            dropzone.classList.add(...activeClasses);
        }

        function deactivate() {
            dropzone.classList.remove(...activeClasses);
        }

        // Prevent browser opening the file
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(evt => {
            dropzone.addEventListener(evt, e => {
                e.preventDefault();
                e.stopPropagation();
            });
        });

        dropzone.addEventListener('dragenter', activate);
        dropzone.addEventListener('dragover', activate);
        dropzone.addEventListener('dragleave', deactivate);

        dropzone.addEventListener('drop', (e) => {
            deactivate();

            const files = e.dataTransfer.files;
            if (!files || !files.length) return;

            // Put file into the hidden input so Laravel receives it
            input.files = files;

            // Preview it
            showPreview(files[0]);
        });
    }
</script>
@endpush