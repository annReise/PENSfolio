<x-app-layout>
    <div class="max-w-5xl mx-auto py-8 px-4">
        {{-- HEADER PROFIL --}}
        <div class="bg-white rounded-xl shadow p-6 flex flex-col md:flex-row gap-6">
            @php
                $avatarUrl = $profile->avatar
                    ? asset('storage/'.$profile->avatar)
                    : 'https://via.placeholder.com/150';
            @endphp

            <img src="{{ $avatarUrl }}"
                 alt="{{ $user->name }}"
                 class="w-32 h-32 rounded-full object-cover">

            <div class="flex-1">
                <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
                <p class="text-gray-500 text-sm">
                    {{ $profile->headline ?? 'Mahasiswa PENS' }}
                </p>

                <p class="mt-3 text-sm text-gray-700">
                    {{ $profile->bio ?? 'Belum ada deskripsi.' }}
                </p>

                <div class="mt-4 flex flex-wrap gap-3 text-sm text-indigo-700">
                    @if($profile->website)
                        <a href="{{ $profile->website }}" target="_blank" class="underline">
                            Website
                        </a>
                    @endif
                    @if($profile->linkedin)
                        <a href="{{ $profile->linkedin }}" target="_blank" class="underline">
                            LinkedIn
                        </a>
                    @endif
                    @if($profile->github)
                        <a href="{{ $profile->github }}" target="_blank" class="underline">
                            GitHub
                        </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- SKILLS --}}
        <div class="mt-8 bg-white rounded-xl shadow p-6">
            <h2 class="text-xl font-semibold mb-3">Keahlian</h2>
            @if($skills->isEmpty())
                <p class="text-sm text-gray-500">Belum menambahkan keahlian.</p>
            @else
                <div class="flex flex-wrap gap-2">
                    @foreach ($skills as $skill)
                        <span class="px-3 py-1 bg-indigo-50 text-indigo-700 text-xs rounded-full">
                            {{ $skill->name }}
                            @if($skill->pivot?->level)
                                <span class="text-[10px] text-gray-500 ml-1">
                                    (Level {{ $skill->pivot->level }})
                                </span>
                            @endif
                        </span>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- PORTFOLIO --}}
        <div class="mt-8 bg-white rounded-xl shadow p-6">
            <h2 class="text-xl font-semibold mb-3">Portofolio Proyek</h2>
            @if($portfolios->isEmpty())
                <p class="text-sm text-gray-500">Belum menambahkan proyek portofolio.</p>
            @else
                <div class="grid md:grid-cols-2 gap-6">
                    @foreach ($portfolios as $portfolio)
                        <div class="border rounded-lg overflow-hidden">
                            @if($portfolio->image)
                                <img src="{{ asset('storage/'.$portfolio->image) }}"
                                     alt="{{ $portfolio->title }}"
                                     class="w-full h-40 object-cover">
                            @else
                                <div class="w-full h-40 bg-gray-100 flex items-center justify-center text-sm text-gray-400">
                                    Tanpa Gambar
                                </div>
                            @endif

                            <div class="p-4 space-y-2">
                                <h3 class="font-semibold text-gray-800">{{ $portfolio->title }}</h3>
                                @if($portfolio->description)
                                    <p class="text-sm text-gray-700">
                                        {{ $portfolio->description }}
                                    </p>
                                @endif

                                @if($portfolio->link)
                                    <a href="{{ $portfolio->link }}" target="_blank"
                                       class="text-xs text-indigo-600 underline">
                                        Lihat Proyek
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
