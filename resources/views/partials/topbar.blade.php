<header class="bg-white shadow-sm sticky top-0 z-20">
    <div class="px-6 lg:px-8 py-4 flex items-center justify-between">
        <div>
            <h1 class="text-xl font-bold text-gray-800">@yield('page_heading', 'Dashboard')</h1>
            <p class="text-sm text-gray-500">@yield('page_subheading', 'Manage your library')</p>
        </div>

        <div class="flex items-center space-x-4">

            {{-- Page-specific action button (Add Book/Add Category etc.) --}}
            @hasSection('header_action')
            @yield('header_action')
            @endif

            {{-- User Dropdown (UI only placeholder) --}}
            <div class="relative">
                <button id="userMenuButton"
                    class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 transition-colors"
                    onclick="toggleDropdown()">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center text-white font-medium text-sm">
                        SM
                    </div>
                    <div class="hidden md:block text-left">
                        <p class="text-sm font-medium text-gray-700">SM Kazal Mahmood</p>
                        <p class="text-xs text-gray-500">kazalmahmoood@gmail.com</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="w-5 h-5 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>

                <div id="userDropdown"
                    class="dropdown-menu absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border py-2">
                    <div class="px-4 py-3 border-b">
                        <p class="text-sm font-medium text-gray-900">Alex Johnson</p>
                        <p class="text-xs text-gray-500 truncate">alex.johnson@example.com</p>
                    </div>
                    <a href="#" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">My Profile</a>
                    <a href="#" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">Edit Profile</a>
                    <a href="#" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">Change Password</a>
                    <div class="border-t my-2"></div>
                    <a href="#" class="block px-4 py-2.5 text-sm text-red-600 hover:bg-red-50">Logout</a>
                </div>
            </div>

        </div>
    </div>
</header>

@push('scripts')
<script>
    function toggleDropdown() {
        const dd = document.getElementById('userDropdown');
        dd.classList.toggle('show');
    }
    document.addEventListener('click', function(e) {
        const btn = document.getElementById('userMenuButton');
        const dd = document.getElementById('userDropdown');
        if (!btn || !dd) return;
        if (!btn.contains(e.target) && !dd.contains(e.target)) dd.classList.remove('show');
    });
</script>
@endpush