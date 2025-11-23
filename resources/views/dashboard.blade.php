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
                    <div class="text-center">
                        <p class="text-sm text-gray-500">Portofolio</p>
                        <p class="text-2xl font-bold">{{ $portfolioCount }}</p>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-gray-500">Keahlian</p>
                        <p class="text-2xl font-bold">{{ $skillCount }}</p>
                    </div>
                </div>
            </div>

            {{-- DAFTAR MAHASISWA LAIN --}}
            <div class="bg-white shadow-lg sm:rounded-xl p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-xl text-gray-800">Mahasiswa Lain</h3>
                    
                    {{-- Counter Badge --}}
                    @php
                        $totalMahasiswa = \App\Models\User::where('role', 'mahasiswa')
                            ->where('id', '!=', auth()->id())
                            ->count();
                    @endphp
                    
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-600">
                            {{ $students->count() }} mahasiswa
                        </span>
                        @if($students->count() < $totalMahasiswa)
                            <span class="text-xs text-amber-600 bg-amber-50 px-3 py-1 rounded-full font-medium">
                                +{{ $totalMahasiswa - $students->count() }} belum setup
                            </span>
                        @endif
                    </div>
                </div>

                @if($students->isEmpty())
                    <div class="text-center py-16 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl">
                        <svg class="w-20 h-20 mx-auto text-blue-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <p class="text-gray-600 text-lg font-medium mb-2">Belum ada mahasiswa lain</p>
                        <p class="text-gray-500 text-sm">Mahasiswa akan muncul setelah mereka setup profil</p>
                    </div>
                @else
                    <div class="grid md:grid-cols-3 gap-6">
                        @foreach ($students as $s)
                            @php
                                $p = $s->profile;
                                $avatar = ($p && $p->avatar)
                                    ? asset('storage/'.$p->avatar)
                                    : 'https://ui-avatars.com/api/?name=' . urlencode($s->name) . '&size=200&background=random';
                            @endphp

                            <div class="group relative bg-white border-2 border-gray-100 rounded-xl p-5 hover:shadow-xl hover:border-blue-200 transition-all duration-300 hover:-translate-y-1">
                                
                                {{-- Avatar dengan Border Gradient --}}
                                <div class="relative mb-4">
                                    @if($p?->username)
                                        <a href="{{ route('public.profile', $p->username) }}" class="block">
                                            <div class="w-24 h-24 mx-auto rounded-full p-1 bg-gradient-to-br from-blue-500 to-indigo-600">
                                                <img src="{{ $avatar }}"
                                                     alt="{{ $s->name }}"
                                                     class="w-full h-full rounded-full object-cover border-4 border-white">
                                            </div>
                                        </a>
                                    @else
                                        <div class="w-24 h-24 mx-auto rounded-full p-1 bg-gradient-to-br from-gray-300 to-gray-400">
                                            <img src="{{ $avatar }}"
                                                 alt="{{ $s->name }}"
                                                 class="w-full h-full rounded-full object-cover border-4 border-white">
                                        </div>
                                    @endif
                                    
                                    
                                </div>

                                {{-- Info --}}
                                <div class="text-center space-y-2">
                                    <h4 class="font-bold text-gray-900 text-lg">{{ $s->name }}</h4>
                                    
                                    <p class="text-sm text-gray-600 min-h-[2.5rem] line-clamp-2">
                                        {{ $p?->headline ?? 'Mahasiswa PENS' }}
                                    </p>

                                    {{-- Skills Tags --}}
                                    <div class="flex flex-wrap justify-center gap-2 pt-2 min-h-[3rem]">
                                        @forelse ($s->skills->take(3) as $skill)
                                            <span class="inline-flex items-center gap-1 text-xs bg-blue-100 text-blue-700 px-3 py-1 rounded-full font-medium">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                                </svg>
                                                {{ $skill->name }}
                                            </span>
                                        @empty
                                            <span class="text-xs text-gray-400 italic">Belum ada keahlian</span>
                                        @endforelse
                                        
                                        @if($s->skills->count() > 3)
                                            <span class="text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded-full font-medium">
                                                +{{ $s->skills->count() - 3 }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Social Links - Simple Version --}}
                                @if($p && ($p->website || $p->linkedin || $p->github))
                                    <div class="mt-4 flex justify-center gap-2">
                                        
                                        {{-- LinkedIn --}}
                                        @if($p->linkedin)
                                            <a href="{{ $p->linkedin }}" target="_blank"
                                               class="p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition"
                                               title="LinkedIn">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                                </svg>
                                            </a>
                                        @endif

                                        {{-- GitHub --}}
                                        @if($p->github)
                                            <a href="{{ $p->github }}" target="_blank"
                                               class="p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition"
                                               title="GitHub">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path>
                                                </svg>
                                            </a>
                                        @endif

                                        {{-- Website - Always Globe Icon --}}
                                        @if($p->website)
                                            <a href="{{ $p->website }}" target="_blank"
                                               class="p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition"
                                               title="Website">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                                </svg>
                                            </a>
                                        @endif
                                        
                                    </div>
                                @endif


                                {{-- View Profile Button --}}
                                @if($p?->username)
                                    <div class="mt-4">
                                        <a href="{{ route('public.profile', $p->username) }}"
                                           class="block w-full text-center px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-semibold rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 shadow-md hover:shadow-lg">
                                            Lihat Profil
                                        </a>
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