<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ $job->title }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-4">

            <div class="flex items-center gap-4">
                @php
                    $logo = $job->company_logo
                        ? asset('storage/'.$job->company_logo)
                        : 'https://via.placeholder.com/80';
                @endphp

                <img src="{{ $logo }}" alt="Logo {{ $job->company_name }}"
                     class="w-16 h-16 rounded object-contain bg-gray-100">

                <div>
                    <h1 class="font-semibold text-lg">{{ $job->title }}</h1>
                    <p class="text-sm text-gray-600">{{ $job->company_name }}</p>
                    <p class="text-xs text-gray-500">
                        {{ $job->location ?? 'Lokasi tidak tersedia' }} ·
                        {{ $job->employment_type ?? 'Tipe tidak tersedia' }}
                    </p>
                </div>
            </div>

            <div class="text-xs text-gray-500">
                Deadline:
                {{ $job->deadline ? $job->deadline->format('d M Y') : 'Tidak ada' }}
            </div>

            @if($job->description)
                <div>
                    <h3 class="font-semibold mb-1 text-sm">Deskripsi Pekerjaan</h3>
                    <p class="text-sm text-gray-700 whitespace-pre-line">
                        {{ $job->description }}
                    </p>
                </div>
            @endif

            @if($job->requirements)
                <div>
                    <h3 class="font-semibold mb-1 text-sm">Requirement / Keahlian yang Dibutuhkan</h3>
                    <p class="text-sm text-gray-700 whitespace-pre-line">
                        {{ $job->requirements }}
                    </p>
                </div>
            @endif

            @if($job->apply_link)
                <div class="pt-2">
                    <a href="{{ $job->apply_link }}" target="_blank"
                       class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-700">
                        Lamar Sekarang
                    </a>
                </div>
            @endif

            <div class="pt-2">
                <a href="{{ route('jobs.index') }}"
                   class="text-xs text-gray-500 hover:underline">
                    ← Kembali ke daftar lowongan
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
