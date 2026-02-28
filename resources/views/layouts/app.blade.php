<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Dashboard') | BookStock</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        indigo: {
                            50: "#eef2ff",
                            100: "#e0e7ff",
                            500: "#6366f1",
                            600: "#4f46e5",
                            700: "#4338ca",
                        },
                        purple: {
                            50: "#faf5ff",
                            500: "#a855f7",
                            600: "#9333ea",
                            700: "#7e22ce",
                        },
                    }
                }
            }
        }
    </script>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap");

        body {
            font-family: "Inter", sans-serif;
        }

        .sidebar-link {
            transition: all 0.2s ease;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background-color: #f3f4f6;
            border-left: 4px solid #4f46e5;
        }

        .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.2s ease;
        }

        .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-50 min-h-screen">
    <div class="flex flex-col lg:flex-row min-h-screen">

        {{-- Sidebar --}}
        @include('partials.sidebar')

        <main class="flex-1 flex flex-col">
            {{-- Top Header --}}
            @if (!View::hasSection('hide_topbar'))
            @include('partials.topbar')
            @endif

            {{-- Main Content --}}
            <div class="flex-1 p-6 lg:p-8">

                @if (session('success'))
                <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 text-green-700">
                    {{ session('success') }}
                </div>
                @endif

                @if (session('error'))
                <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700">
                    {{ session('error') }}
                </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
</body>

</html>