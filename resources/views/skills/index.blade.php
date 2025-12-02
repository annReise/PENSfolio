<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Keahlian Saya
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 text-green-700 bg-green-100 border border-green-300 px-4 py-2 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-6 flex justify-end">
                <a href="{{ route('skills.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md hover:bg-blue-800 transition">
                    + Tambah Skill
                </a>
            </div>

            @if ($skills->isEmpty())
                <div class="bg-white shadow-lg rounded-xl p-12 text-center">
                    <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-gray-500 text-lg mb-6">Belum ada skill. Tambahkan minimal satu skill</p>
                    <a href="{{ route('skills.create') }}"
                       class="inline-block px-6 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md hover:bg-blue-800 transition">
                        Tambah Skill Pertama
                    </a>
                </div>
            @else
                {{-- Grouping by Category --}}
                @php
                    $groupedSkills = $skills->groupBy('category');
                @endphp

                <div class="space-y-6">
                    @foreach ($groupedSkills as $category => $categorySkills)
                        <div class="bg-white shadow-lg rounded-xl p-6 border-2 border-gray-100">
                            <h3 class="text-lg font-bold text-blue-900 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                {{ $category ?: 'Lainnya' }}
                            </h3>

                            <div class="flex flex-wrap gap-3">
                                @foreach ($categorySkills as $skill)
                                    <div class="group relative">
                                        <div class="flex items-center gap-3 px-4 py-2 bg-gradient-to-r from-blue-50 to-blue-100 border-2 border-blue-200 rounded-full hover:shadow-md transition-all duration-300 hover:scale-105">
                                            
                                            <span class="font-semibold text-blue-900">{{ $skill->name }}</span>

                                            <div class="flex items-center gap-1">
                                                <a href="{{ route('skills.edit', $skill) }}" 
                                                   class="text-blue-700 hover:text-blue-900 transition p-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                </a>

                                                <form action="{{ route('skills.destroy', $skill) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Hapus skill ini?')"
                                                      class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 transition p-1">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

            @endif

        </div>
    </div>
</x-app-layout>