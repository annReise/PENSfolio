<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lowongan Pekerjaan
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($jobs->isEmpty())
                <div class="bg-white shadow-lg rounded-xl p-16 text-center">
                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <p class="text-gray-600 text-lg font-medium mb-2">Belum Ada Lowongan Tersedia</p>
                    <p class="text-gray-500 text-sm">Lowongan pekerjaan akan muncul di sini ketika sudah ada yang dipublish</p>
                </div>
            @else
                {{-- Header Stats --}}
                <div class="bg-white shadow-lg rounded-xl p-6 mb-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800">Temukan Pekerjaanmu!</h3>
                            <p class="text-gray-600 mt-1">{{ $jobs->total() }} lowongan tersedia</p>
                        </div>
                        <div class="hidden md:block">
                            <svg class="w-16 h-16 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Jobs Grid --}}
                <div class="grid md:grid-cols-2 gap-6">
                    @foreach($jobs as $job)
                        <div class="bg-white shadow-lg hover:shadow-xl transition-all duration-300 rounded-xl overflow-hidden border-2 border-gray-100 hover:border-blue-200 group">
                            
                            {{-- Company Logo & Info --}}
                            <div class="p-6 bg-gradient-to-br from-blue-50 to-indigo-50">
                                <div class="flex items-start gap-4">
                                    @php
                                        $logo = $job->company_logo
                                            ? asset('storage/'.$job->company_logo)
                                            : 'https://ui-avatars.com/api/?name=' . urlencode($job->company_name) . '&size=100&background=3b82f6&color=fff';
                                    @endphp
                                    
                                    <div class="bg-white p-2 rounded-lg shadow-md">
                                        <img src="{{ $logo }}" alt="Logo {{ $job->company_name }}"
                                             class="w-16 h-16 rounded object-contain">
                                    </div>

                                    <div class="flex-1">
                                        <h3 class="font-bold text-lg text-gray-900 group-hover:text-blue-600 transition line-clamp-2">
                                            {{ $job->title }}
                                        </h3>
                                        <p class="text-sm text-gray-700 font-medium mt-1">{{ $job->company_name }}</p>
                                        
                                        <div class="flex flex-wrap gap-2 mt-3">
                                            {{-- Location Badge --}}
                                            @if($job->location)
                                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-white text-blue-700 text-xs font-medium rounded-full">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                    {{ $job->location }}
                                                </span>
                                            @endif

                                            {{-- Employment Type Badge --}}
                                            @if($job->employment_type)
                                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-white text-green-700 text-xs font-medium rounded-full">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    {{ $job->employment_type }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="p-6 space-y-4">
                                @if($job->description)
                                    <p class="text-sm text-gray-700 line-clamp-3 leading-relaxed">
                                        {{ Str::limit($job->description, 140) }}
                                    </p>
                                @endif

                                {{-- Footer --}}
                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <div class="flex items-center gap-2 text-xs text-gray-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="font-medium">
                                            {{ $job->deadline ? $job->deadline->format('d M Y') : 'Tidak ada deadline' }}
                                        </span>
                                    </div>
                                    
                                    <a href="{{ route('jobs.show', $job) }}"
                                       class="inline-flex items-center gap-1 px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition">
                                        Lihat Detail
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-8">
                    {{ $jobs->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>