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

            <div class="mb-6 flex justify-end">
                <a href="{{ route('portfolio.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md hover:bg-blue-800 transition">
                    + Tambah Proyek
                </a>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                @forelse ($portfolios as $portfolio)
                    <div class="bg-white shadow-lg hover:shadow-xl transition-all duration-300 rounded-xl overflow-hidden border-2 border-gray-100 hover:scale-105">

                        @if ($portfolio->image)
                            <img src="{{ asset('storage/' . $portfolio->image) }}"
                                 alt="{{ $portfolio->title }}"
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center text-gray-500 text-sm font-medium">
                                Tanpa Gambar
                            </div>
                        @endif

                        <div class="p-5 space-y-3">
                            <h3 class="font-bold text-gray-900 text-lg leading-tight">{{ $portfolio->title }}</h3>

                            @if ($portfolio->description)
                                <p class="text-sm text-gray-600 line-clamp-3">
                                    {{ $portfolio->description }}
                                </p>
                            @endif

                            @if ($portfolio->link)
                                <a href="{{ $portfolio->link }}" target="_blank"
                                   class="inline-block text-xs text-blue-900 font-semibold underline hover:text-blue-700">
                                    Lihat Proyek →
                                </a>
                            @endif

                            <div class="flex justify-end gap-2 pt-3 border-t border-gray-100">
                                <a href="{{ route('portfolio.edit', $portfolio) }}"
                                   class="text-xs px-3 py-1.5 border border-blue-900 text-blue-900 rounded-md hover:bg-blue-900 hover:text-white transition">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('portfolio.destroy', $portfolio) }}"
                                      onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-xs px-3 py-1.5 bg-red-500 text-white rounded-md hover:bg-red-600 transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-100 text-lg">Belum ada proyek portofolio</p>
                        <a href="{{ route('portfolio.create') }}"
                           class="inline-block mt-7 px-5 py-2 bg-blue-600 text-white text-base font-semibold rounded-md hover:bg-blue-800 transition">
                            Buat Proyek Pertama
                        </a>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>