{{-- resources/views/portfolio/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Portofolio Saya
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 text-green-700 bg-green-100 border border-green-300 px-4 py-2 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4 flex justify-end">
                <a href="{{ route('portfolio.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-xs font-semibold rounded-md hover:bg-indigo-500">
                    Tambah Proyek
                </a>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                @forelse ($portfolios as $portfolio)
                    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                        @if ($portfolio->image)
                            <img
                                src="{{ asset('storage/' . $portfolio->image) }}"
                                alt="{{ $portfolio->title }}"
                                class="w-full h-40 object-cover"
                            >
                        @else
                            <div class="w-full h-40 bg-gray-100 flex items-center justify-center text-gray-400 text-sm">
                                Tanpa Gambar
                            </div>
                        @endif

                        <div class="p-4 space-y-2">
                            <h3 class="font-semibold text-gray-800">
                                {{ $portfolio->title }}
                            </h3>
                            @if ($portfolio->description)
                                <p class="text-sm text-gray-700 line-clamp-3">
                                    {{ $portfolio->description }}
                                </p>
                            @endif

                            @if ($portfolio->link)
                                <a href="{{ $portfolio->link }}" target="_blank" class="text-xs text-indigo-600 underline">
                                    Lihat Proyek
                                </a>
                            @endif

                            <div class="flex justify-end gap-2 mt-3">
                                <a href="{{ route('portfolio.edit', $portfolio) }}"
                                class="text-xs px-3 py-1 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('portfolio.destroy', $portfolio) }}"
                                    onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-xs px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600">
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada proyek portofolio.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
