<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - PENSfolio</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex">

    {{-- SIDEBAR --}}
    <aside id="sidebar" class="w-64 bg-gray-900 text-white h-screen flex flex-col transition-all duration-300 fixed">
        <div class="p-4 text-2xl font-bold border-b border-gray-700 flex items-center justify-between">
            <span id="sidebar-title">Admin Panel</span>
            
            {{-- Tombol Toggle Sidebar --}}
            <button id="toggle-sidebar" class="p-1 hover:bg-gray-800 rounded transition">
                <svg id="icon-collapse" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
                </svg>
                <svg id="icon-expand" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>

        <nav class="mt-4 space-y-1 flex-1 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-4 py-2 hover:bg-gray-800 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span class="sidebar-text">Dashboard</span>
            </a>

            <a href="{{ route('admin.jobs.index') }}"
               class="flex items-center gap-3 px-4 py-2 hover:bg-gray-800 {{ request()->is('admin/jobs*') ? 'bg-gray-800' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                <span class="sidebar-text">Lowongan</span>
            </a>
        </nav>
        
        {{-- User Info & Logout - Sticky di bawah --}}
        <div class="border-t border-gray-700 p-4 mt-auto">
            {{-- Tombol Logout (hidden by default) --}}
            <form id="logout-form" method="POST" action="{{ route('logout') }}" class="w-full mb-2 hidden">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span class="sidebar-text">Logout</span>
                </button>
            </form>

            {{-- Avatar yang bisa diklik --}}
            <button id="user-menu-btn" class="w-full flex items-center gap-3 justify-center hover:bg-gray-800 rounded-lg p-2 transition">
                <div class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div class="flex-1 min-w-0 text-left sidebar-text">
                    <p class="text-sm font-medium truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-400">Admin</p>
                </div>
            </button>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 ml-64 transition-all duration-300" id="main-content">
        <header class="bg-white shadow-sm border-b border-gray-200">
            <div class="px-6 py-4 flex items-center justify-between">
                {{-- Title di kiri --}}
                <h1 class="text-xl font-semibold text-gray-800">
                    @yield('title', 'Admin')
                </h1>
                
                {{-- Logo di kanan --}}
                <div class="flex items-center gap-4">
                    <img src="{{ asset('images/pensfolio (3).png') }}" alt="PENS Logo" class="h-12 w-auto">
                </div>
            </div>
        </header>

        <section class="p-6">
            @yield('content')
        </section>
    </main>

    {{-- JavaScript untuk Toggle Sidebar --}}
    <script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const toggleBtn = document.getElementById('toggle-sidebar');
        const iconCollapse = document.getElementById('icon-collapse');
        const iconExpand = document.getElementById('icon-expand');
        const sidebarTexts = document.querySelectorAll('.sidebar-text');
        const sidebarTitle = document.getElementById('sidebar-title');
        const userMenuBtn = document.getElementById('user-menu-btn');
        const logoutForm = document.getElementById('logout-form');

        // Toggle Sidebar
        toggleBtn.addEventListener('click', () => {
            const isCollapsed = sidebar.classList.contains('w-16');
            
            if (isCollapsed) {
                // Expand
                sidebar.classList.remove('w-16');
                sidebar.classList.add('w-64');
                mainContent.classList.remove('ml-16');
                mainContent.classList.add('ml-64');
                iconCollapse.classList.remove('hidden');
                iconExpand.classList.add('hidden');
                sidebarTexts.forEach(text => text.classList.remove('hidden'));
                sidebarTitle.classList.remove('hidden');
            } else {
                // Collapse
                sidebar.classList.remove('w-64');
                sidebar.classList.add('w-16');
                mainContent.classList.remove('ml-64');
                mainContent.classList.add('ml-16');
                iconCollapse.classList.add('hidden');
                iconExpand.classList.remove('hidden');
                sidebarTexts.forEach(text => text.classList.add('hidden'));
                sidebarTitle.classList.add('hidden');
            }
            
            // Hide logout form when toggling sidebar
            if (logoutForm) {
                logoutForm.classList.add('hidden');
            }
        });

        // Toggle Logout Form saat avatar diklik
        if (userMenuBtn && logoutForm) {
            userMenuBtn.addEventListener('click', () => {
                logoutForm.classList.toggle('hidden');
            });
        }
    </script>

</body>
</html>