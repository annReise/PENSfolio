<x-app-layout>
    <div class="max-w-4xl mx-auto p-6">

        {{-- HEADER PROFIL --}}
        <div class="text-center mb-6">
            <img
                src="{{ $profile?->avatar_path ? asset('storage/'.$profile->avatar_path) : 'https://via.placeholder.com/150' }}"
                class="mx-auto rounded-full w-32 h-32 object-cover"
                alt="Foto {{ $profile->full_name ?? $user->name }}"
            >

            <h1 class="text-3xl font-bold mt-4">
                {{ $profile->full_name ?? $user->name }}
            </h1>

            <p class="text-gray-600">
                {{ $profile->study_program ?? 'Program Studi belum diisi' }}
            </p>

            {{-- Link sosial opsional --}}
            <div class="flex justify-center gap-4 mt-3 text-sm">
                @if ($profile?->website)
                    <a href="{{ $profile->website }}" target="_blank" class="text-blue-600 underline">
                        Website
                    </a>
                @endif

                @if ($profile?->linkedin)
                    <a href="{{ $profile->linkedin }}" target="_blank" class="text-blue-600 underline">
                        LinkedIn
                    </a>
                @endif

                @if ($profile?->github)
                    <a href="{{ $profile->github }}" target="_blank" class="text-blue-600 underline">
                        GitHub
                    </a>
                @endif
            </div>
        </div>

        {{-- TENTANG SAYA --}}
        <h2 class="text-xl font-bold mb-2">Tentang Saya</h2>
        <p class="text-gray-700 mb-6">
            {{ $profile?->bio ?? 'Mahasiswa ini belum menuliskan deskripsi dirinya.' }}
        </p>

        {{-- PORTFOLIO --}}
        <h2 class="text-xl font-bold mb-3">Portofolio</h2>

        @if ($portfolios->isEmpty())
            <p class="text-gray-500 mb-6">Belum ada portofolio yang ditampilkan.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                @foreach ($portfolios as $portfolio)
                    <div class="bg-white p-4 rounded-xl shadow">
                        <img
                            src="{{ $portfolio->thumbnail_path ? asset('storage/'.$portfolio->thumbnail_path) : 'https://via.placeholder.com/300x180' }}"
                            class="rounded-lg mb-3 w-full h-44 object-cover"
                            alt="{{ $portfolio->title }}"
                        >
                        <h3 class="font-bold text-lg">{{ $portfolio->title }}</h3>
                        <p class="text-gray-600 text-sm mb-2">
                            {{ \Illuminate\Support\Str::limit($portfolio->description, 120) }}
                        </p>

                        @if ($portfolio->project_url)
                            <a href="{{ $portfolio->project_url }}"
                               target="_blank"
                               class="text-blue-600 text-sm underline">
                                Lihat Proyek
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        {{-- SKILL --}}
        <h2 class="text-xl font-bold mt-4 mb-3">Keahlian</h2>

        @if ($skills->isEmpty())
            <p class="text-gray-500">Belum ada skill yang ditambahkan.</p>
        @else
            <div class="flex flex-wrap gap-2">
                @foreach ($skills as $skill)
                    <span class="px-3 py-2 bg-blue-100 text-blue-700 rounded-lg text-sm">
                        {{ $skill->name }}
                        @if ($skill->category)
                            <span class="text-xs text-gray-500">({{ $skill->category }})</span>
                        @endif
                    </span>
                @endforeach
            </div>
        @endif

    </div>
</x-app-layout>
