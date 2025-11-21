<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | PENSfolio</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-gray-900 text-gray-100 flex flex-col">
        <div class="px-6 py-4 border-b border-gray-800">
            <div class="text-xl font-bold text-blue-400">
                PENSfolio Admin
            </div>
        </div>

        <nav class="flex-1 px-4 py-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}"
               class="block px-3 py-2 rounded-md text-sm
                     {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-800' }}">
                Dashboard
            </a>

            {{-- contoh menu lain --}}
            <a href="{{ route('dashboard') }}"
               class="block px-3 py-2 rounded-md text-sm text-gray-300 hover:bg-gray-800">
                Kembali ke Dashboard Mahasiswa
            </a>
        </nav>

        <div class="px-4 py-4 border-t border-gray-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full text-left px-3 py-2 rounded-md text-sm bg-red-600 hover:bg-red-500">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 flex flex-col">
        {{-- TOPBAR --}}
        <header class="bg-white shadow-sm px-6 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-xl font-semibold">
                    @yield('title', 'Dashboard Admin')
                </h1>
                <p class="text-sm text-gray-500">
                    @yield('subtitle')
                </p>
            </div>

            <div class="flex items-center gap-3">
                @php
                    $admin = Auth::user();
                    $profile = $admin->profile ?? null;
                    $avatar = $profile && $profile->avatar
                        ? asset('storage/'.$profile->avatar)
                        : 'https://ui-avatars.com/api/?name='.urlencode($admin->name).'&size=64';
                @endphp

                <span class="text-sm text-gray-700">{{ $admin->name }}</span>
                <img src="{{ $avatar }}" alt="Admin Avatar" class="w-9 h-9 rounded-full object-cover">
            </div>
        </header>

        <section class="flex-1 p-6">
            @yield('content')
        </section>
    </main>
</body>
</html>
