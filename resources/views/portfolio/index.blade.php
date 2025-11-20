<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">

        <div class="flex justify-between mb-6">
            <h1 class="text-3xl font-bold">Portofolio Kamu</h1>
            <a href="{{ route('portfolio.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">+ Tambah Proyek</a>
        </div>

        {{-- LIST CARD PROYEK --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse ($portfolios as $portfolio)
                <div class="bg-white p-4 rounded-xl shadow">
                    @if ($portfolio->image)
                        <img src="{{ asset('storage/'.$portfolio->image) }}"
                             class="rounded-lg mb-3">
                    @else
                        <img src="https://via.placeholder.com/400x200"
                             class="rounded-lg mb-3">
                    @endif

                    <h2 class="font-bold text-xl">{{ $portfolio->title }}</h2>
                    <p class="text-gray-600 text-sm mb-3">
                        {{ \Illuminate\Support\Str::limit($portfolio->description, 100) }}
                    </p>

                    <div class="flex justify-between items-center text-sm">
                        <a href="{{ route('portfolio.edit', $portfolio) }}" class="text-blue-600">Edit</a>
                        <a href="{{ route('portfolio.show', $portfolio) }}" class="text-green-600">Lihat</a>

                        <form action="{{ route('portfolio.destroy', $portfolio) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-gray-600">Belum ada portofolio. Tambahkan proyek pertamamu!</p>
            @endforelse

        </div>

    </div>
</x-app-layout>
