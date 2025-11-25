<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Lowongan Pekerjaan
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            @if($jobs->isEmpty())
                <p class="text-gray-500 text-sm">Belum ada lowongan yang tersedia.</p>
            @else
                <div class="grid md:grid-cols-2 gap-6">
                    @foreach($jobs as $job)
                        <div class="border rounded-lg p-4 flex flex-col gap-3">
                            <div class="flex items-center gap-3">
                                @php
                                    $logo = $job->company_logo
                                        ? asset('storage/'.$job->company_logo)
                                        : 'https://via.placeholder.com/60';
                                @endphp
                                <img src="{{ $logo }}" alt="Logo {{ $job->company_name }}"
                                     class="w-12 h-12 rounded object-contain bg-gray-100">
                                <div>
                                    <h3 class="font-semibold">{{ $job->title }}</h3>
                                    <p class="text-xs text-gray-600">{{ $job->company_name }}</p>
                                </div>
                            </div>

                            <p class="text-xs text-gray-500">
                                {{ $job->location ?? 'Lokasi tidak tersedia' }} ·
                                {{ $job->employment_type ?? 'Tipe tidak tersedia' }}
                            </p>

                            @if($job->description)
                                <p class="text-sm text-gray-700 line-clamp-3">
                                    {{ Str::limit($job->description, 140) }}
                                </p>
                            @endif

                            <div class="flex justify-between items-center mt-2 text-xs text-gray-500">
                                <span>
                                    Deadline:
                                    {{ $job->deadline ? $job->deadline->format('d M Y') : 'Tidak ada' }}
                                </span>
                                <a href="{{ route('jobs.show', $job) }}"
                                   class="text-indigo-600 hover:underline">
                                    Detail
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    {{ $jobs->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
