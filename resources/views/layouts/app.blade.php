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
    <li>
        <a href="/dashboard" 
           class="{{ request()->is('dashboard') ? 'text-blue-600 font-semibold' : 'hover:text-blue-600' }}">
            Dashboard
        </a>
    </li>

    <li>
        <a href="/portfolio" 
           class="{{ request()->is('portfolio*') ? 'text-blue-600 font-semibold' : 'hover:text-blue-600' }}">
            Portofolio
        </a>
    </li>

    <li>
        <a href="/skills" 
           class="{{ request()->is('skills*') ? 'text-blue-600 font-semibold' : 'hover:text-blue-600' }}">
            Keahlian
        </a>
    </li>

    <li>
        <a href="/profile" 
           class="{{ request()->is('profile*') ? 'text-blue-600 font-semibold' : 'hover:text-blue-600' }}">
            Profil
        </a>
    </li>

    {{-- Logout as a normal link --}}
    @auth
    <li>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button 
                type="submit"
                class="text-gray-700 hover:text-blue-600 transition"
            >
                Logout
            </button>
        </form>
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
