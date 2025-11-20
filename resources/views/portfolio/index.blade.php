<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">

        <div class="flex justify-between mb-6">
            <h1 class="text-3xl font-bold">Portofolio Kamu</h1>
            <a href="/portfolio/create"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">+ Tambah Proyek</a>
        </div>

        {{-- LIST CARD PROYEK --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            {{-- contoh tampilan, backend yang mengisi data --}}
            <div class="bg-white p-4 rounded-xl shadow">
                <img src="https://via.placeholder.com/400x200"
                     class="rounded-lg mb-3">
                <h2 class="font-bold text-xl">Nama Proyek</h2>
                <p class="text-gray-600 text-sm mb-3">Deskripsi singkat proyek...</p>

                <div class="flex justify-between">
                    <a href="/portfolio/1/edit" class="text-blue-600">Edit</a>
                    <a href="/portfolio/1" class="text-green-600">Lihat</a>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
