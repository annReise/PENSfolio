<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Lowongan
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Company Header Card --}}
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 shadow-xl rounded-xl p-8 mb-6">
                <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                     @php
    if ($job->company_logo) {
        // Kalau logo adalah URL dari UI Avatar
        if (Str::startsWith($job->company_logo, ['http://', 'https://'])) {
            $logo = $job->company_logo;
        } 
        // Kalau logo adalah path lokal dari storage
        else {
            $logo = asset('storage/'.$job->company_logo);
        }
    } else {
        $logo = 'https://ui-avatars.com/api/?name=' . urlencode($job->company_name) . '&size=100&background=3b82f6&color=fff';
    }
@endphp

                    <div class="bg-white p-3 rounded-xl shadow-lg">
                        <img src="{{ $logo }}" alt="Logo {{ $job->company_name }}"
                             class="w-24 h-24 rounded-lg object-contain">
                    </div>

                    <div class="flex-1">
                        <h1 class="font-bold text-3xl mb-2">{{ $job->title }}</h1>
                        <p class="text-xl text-gray-800 font-medium mb-3">{{ $job->company_name }}</p>
                        
                        <div class="flex flex-wrap gap-3">
                            @if($job->location)
                                <span class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-blue-200 rounded-lg text-sm font-medium text-blue-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $job->location }}
                                </span>
                            @endif

                            @if($job->employment_type)
                                <span class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-blue-200 rounded-lg text-sm font-medium text-blue-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $job->employment_type }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Deadline Badge --}}
                @if($job->deadline)
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex items-center gap-2 text-gray-600">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-sm">Deadline:</span>
                            <span class="font-bold text-gray-800 text-base">{{ $job->deadline->format('d M Y') }}</span>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Main Content Card --}}
            <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                
                {{-- Description Section --}}
                @if($job->description)
                    <div class="p-8 border-b border-gray-100">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="font-bold text-xl text-gray-800">Deskripsi Pekerjaan</h3>
                        </div>
                        <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $job->description }}</p>
                    </div>
                @endif

                {{-- Requirements Section --}}
                @if($job->requirements)
                    <div class="p-8 bg-gradient-to-br from-gray-50 to-blue-50">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-indigo-100 rounded-lg">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                </svg>
                            </div>
                            <h3 class="font-bold text-xl text-gray-800">Requirement / Keahlian yang Dibutuhkan</h3>
                        </div>
                        <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $job->requirements }}</p>
                    </div>
                @endif

                {{-- Action Buttons --}}
                <div class="p-8 bg-gray-50 flex flex-col sm:flex-row gap-4">
                    @if($job->apply_link)
                        <a href="{{ $job->apply_link }}" target="_blank"
                           class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-base font-bold rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Lamar Sekarang
                        </a>
                    @endif

                    <a href="{{ route('jobs.index') }}"
   class="inline-flex items-center justify-center gap-2 px-6 py-3 border-2 border-blue-600 text-blue-600 bg-white text-base font-semibold rounded-lg hover:bg-blue-600 hover:text-white active:bg-blue-700 transition-all duration-200">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
    </svg>
    Kembali ke Daftar
</a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>