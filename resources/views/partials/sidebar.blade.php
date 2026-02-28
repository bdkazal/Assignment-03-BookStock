@php
$routeName = \Illuminate\Support\Facades\Route::currentRouteName();
$isActive = fn(array $names) => in_array($routeName, $names);
@endphp

<aside class="lg:w-64 bg-white shadow-lg z-10 lg:h-screen lg:sticky lg:top-0">
    <div class="p-6 border-b">
        <div class="flex items-center space-x-3">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 w-10 h-10 rounded-xl flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-white">
                    <path fill-rule="evenodd"
                        d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div>
                <h1 class="font-bold text-lg bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                    BookStock
                </h1>
                <p class="text-xs text-gray-500">Dashboard-Assignment-03</p>
            </div>
        </div>
    </div>

    <div class="p-4">
        <nav class="space-y-1">

            <div class="pt-2 pb-2">
                <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Book Management</p>
            </div>

            <a href="{{ route('books.index') }}"
                class="flex items-center space-x-3 p-3 rounded-lg sidebar-link {{ $isActive(['books.index','books.create','books.edit']) ? 'active' : '' }}">
                <span class="font-medium">Books</span>
            </a>

            <a href="{{ route('categories.index') }}"
                class="flex items-center space-x-3 p-3 rounded-lg sidebar-link {{ $isActive(['categories.index','categories.create','categories.edit']) ? 'active' : '' }}">
                <span class="font-medium">Categories</span>
            </a>

            <a href="{{ route('authors.index') }}"
                class="flex items-center space-x-3 p-3 rounded-lg sidebar-link {{ $isActive(['authors.index','authors.create','authors.edit']) ? 'active' : '' }}">
                <span class="font-medium">Authors</span>
            </a>

            <div class="pt-4"></div>

            <a href="#"
                class="flex items-center space-x-3 p-3 rounded-lg sidebar-link">
                <span class="font-medium">Logout</span>
            </a>

        </nav>
    </div>
</aside>