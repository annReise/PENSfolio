<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- RINGKASAN DIRI SENDIRI --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6 flex flex-col md:flex-row justify-between gap-6">
                <div class="flex items-center gap-4">
                    @php
                        $avatarUrl = $profile && $profile->avatar
                            ? asset('storage/'.$profile->avatar)
                            : 'https://via.placeholder.com/80';
                    @endphp

                    <img src="{{ $avatarUrl }}" class="w-16 h-16 rounded-full object-cover" alt="Avatar">

                    <div>
                        <h3 class="font-semibold text-lg">{{ $user->name }}</h3>
                        <p class="text-sm text-gray-600">
                            {{ $profile->headline ?? 'Belum ada headline' }}
                        </p>
                        @if ($profile?->username)
                            <a href="{{ route('public.profile', $profile->username) }}"
                               class="text-xs text-indigo-600 underline">
                                Lihat profil publik
                            </a>
                        @endif
                    </div>
                </div>

                <div class="flex gap-8 items-center">
                    <div>
                        <p class="text-sm text-gray-500">Portofolio</p>
                        <p class="text-2xl font-bold">{{ $portfolioCount }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Keahlian</p>
                        <p class="text-2xl font-bold">{{ $skillCount }}</p>
                    </div>
                </div>
            </div>

            {{-- DAFTAR MAHASISWA LAIN --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-lg mb-4">Mahasiswa Lain</h3>

                @if($students->isEmpty())
                    <p class="text-gray-500 text-sm">Belum ada mahasiswa lain yang mengisi profil.</p>
                @else
                    <div class="grid md:grid-cols-3 gap-6">
                        @foreach ($students as $s)
                            @php
                                $p = $s->profile;
                                $avatar = $p && $p->avatar
                                    ? asset('storage/'.$p->avatar)
                                    : 'https://via.placeholder.com/120';
                            @endphp

                            <div class="border rounded-lg p-4 flex flex-col items-center text-center">
                                <a href="{{ $p?->username ? route('public.profile', $p->username) : '#' }}">
                                    <img src="{{ $avatar }}"
                                         alt="{{ $s->name }}"
                                         class="w-20 h-20 rounded-full object-cover mb-3">
                                </a>

                                <h4 class="font-semibold">{{ $s->name }}</h4>
                                <p class="text-xs text-gray-500 mb-2">
                                    {{ $p?->headline ?? 'Mahasiswa PENS' }}
                                </p>

                                {{-- tampilkan beberapa skill --}}
                                <div class="flex flex-wrap justify-center gap-2 mt-2">
                                    @foreach ($s->skills->take(4) as $skill)
                                        <span class="text-xs bg-indigo-50 text-indigo-700 px-2 py-1 rounded-full">
                                            {{ $skill->name }}
                                        </span>
                                    @endforeach

                                    @if($s->skills->count() === 0)
                                        <span class="text-xs text-gray-400">Belum ada keahlian</span>
                                    @endif
                                </div>

                                {{-- kontak singkat --}}
                                @if($p?->website || $p?->linkedin || $p?->github)
                                    <div class="mt-3 flex gap-3 justify-center text-xs text-indigo-600">
                                        @if($p->website)
                                            <a href="{{ $p->website }}" target="_blank">Website</a>
                                        @endif
                                        @if($p->linkedin)
                                            <a href="{{ $p->linkedin }}" target="_blank">LinkedIn</a>
                                        @endif
                                        @if($p->github)
                                            <a href="{{ $p->github }}" target="_blank">GitHub</a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
