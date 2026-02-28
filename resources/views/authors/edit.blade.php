@extends('layouts.app')

@section('title', 'Edit Author')
@section('hide_topbar', true)

@section('content')
<header class="bg-white shadow-sm sticky top-0 z-20 -mx-6 lg:-mx-8 px-6 lg:px-8 py-4">
    <div class="flex items-center justify-between">
        <div class="flex items-start gap-4">
            <a href="{{ route('authors.index') }}" class="mt-1 text-gray-500 hover:text-gray-800 transition" title="Back">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7 7-7" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18" />
                </svg>
            </a>
            <div>
                <h1 class="text-xl font-bold text-gray-900">Edit Author</h1>
                <p class="text-sm text-gray-500">Update author information</p>
            </div>
        </div>
    </div>
</header>

<div class="max-w-3xl mx-auto mt-6">
    @if ($errors->any())
    <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700">
        <ul class="list-disc list-inside text-sm space-y-1">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-2"></div>

        <form action="{{ route('authors.update', $author->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="p-6 space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Author Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name', $author->name) }}"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-white
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('name')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Bio
                    </label>
                    <textarea name="bio" rows="5"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 bg-white
                                     focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('bio', $author->bio) }}</textarea>
                    @error('bio')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="px-6 pb-6 flex justify-end gap-3">
                <a href="{{ route('authors.index') }}"
                    class="px-6 py-3 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-50 transition">
                    Cancel
                </a>
                <button type="submit"
                    class="px-6 py-3 rounded-xl text-white font-semibold
                               bg-gradient-to-r from-indigo-600 to-purple-600
                               hover:from-indigo-700 hover:to-purple-700 transition shadow">
                    Update Author
                </button>
            </div>
        </form>
    </div>
</div>
@endsection