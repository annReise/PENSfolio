<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PENSfolio</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    {{-- HEADER --}}
    <header class="bg-white shadow-md sticky top-0 z-50">
        <nav class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold text-blue-600">
                PENSfolio
            </div>

            <ul class="flex gap-6 font-medium items-center">
                <li><a href="/dashboard" class="{{ request()->is('dashboard') ? 'text-blue-600 font-semibold' : 'hover:text-blue-600' }}">Dashboard</a></li>
                <li><a href="/portfolio" class="{{ request()->is('portfolio*') ? 'text-blue-600 font-semibold' : 'hover:text-blue-600' }}">Portofolio</a></li>
                <li><a href="/skills" class="{{ request()->is('skills*') ? 'text-blue-600 font-semibold' : 'hover:text-blue-600' }}">Keahlian</a></li>

                {{-- User Dropdown --}}
                {{-- User Dropdown --}}
{{-- di resources/views/layouts/app.blade.php di bagian dropdown user --}}

@auth
<li>
    <div x-data="{ open: false }" class="relative">
        @php
            $p = Auth::user()->profile;
            $avatarNav = $p && $p->avatar
                ? asset('storage/'.$p->avatar)
                : 'https://via.placeholder.com/40';
        @endphp

        <button @click="open = !open" class="flex items-center gap-2">
            <img src="{{ $avatarNav }}" class="w-9 h-9 rounded-full object-cover" alt="Me">
            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <div x-show="open"
             @click.outside="open = false"
             class="absolute right-0 mt-2 w-44 bg-white shadow-md rounded-md py-2 z-50"
             x-transition>
            <a href="{{ route('profile.index') }}"
               class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                Profil
            </a>

            <a href="{{ route('password.edit') }}"
               class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                Ubah Password
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                    Logout
                </button>
            </form>
        </div>
    </div>
</li>
@endauth


            </ul>
        </nav>
    </header>

    {{-- MAIN CONTENT --}}
    <main class="py-8 flex-grow">
        {{ $slot }}
    </main>

    {{-- FOOTER --}}
    <footer class="bg-gray-900 text-white text-center py-4 mt-10">
        <p>PENSfolio © {{ date('Y') }} - All rights reserved</p>
    </footer>

</body>
</html>
