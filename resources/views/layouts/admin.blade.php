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
    <aside class="w-64 bg-gray-900 text-white min-h-screen">
        <div class="p-4 text-2xl font-bold border-b border-gray-700">
            Admin Panel
        </div>

        <nav class="mt-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-2 hover:bg-gray-800 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800' : '' }}">
                Dashboard
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="block px-4 py-2 hover:bg-gray-800 {{ request()->routeIs('admin.users.*') ? 'bg-gray-800' : '' }}">
                Mahasiswa
            </a>

            <a href="{{ route('dashboard') }}"
               class="block px-4 py-2 hover:bg-gray-800">
                Kembali ke User Dashboard
            </a>
        </nav>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="flex-1">
        <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold">
                @yield('title', 'Admin')
            </h1>

            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-600">
                    {{ auth()->user()->name }} (Admin)
                </span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-sm text-red-600 hover:underline">
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <section class="p-6">
            @yield('content')
        </section>
    </main>

</body>
</html>
