<x-app-layout>
    <div class="max-w-4xl mx-auto p-6">

        <div class="text-center mb-6">
            <img src="https://via.placeholder.com/150"
                 class="mx-auto rounded-full w-32 h-32">

            <h1 class="text-3xl font-bold mt-4">Nama Mahasiswa</h1>
            <p class="text-gray-600">Program Studi</p>
        </div>

        <h2 class="text-xl font-bold mb-2">Tentang Saya</h2>
        <p class="text-gray-700 mb-6">
            Deskripsi singkat tentang mahasiswa...
        </p>

        <h2 class="text-xl font-bold mb-3">Portofolio</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="bg-white p-4 rounded-xl shadow">
                <img src="https://via.placeholder.com/300x180"
                     class="rounded-lg mb-3">
                <h3 class="font-bold">Nama Proyek</h3>
                <p class="text-gray-600">Deskripsi singkat...</p>
            </div>

        </div>

        <h2 class="text-xl font-bold mt-8 mb-3">Keahlian</h2>
        <div class="flex flex-wrap gap-2">
            <span class="px-3 py-2 bg-blue-100 text-blue-700 rounded-lg">Laravel</span>
            <span class="px-3 py-2 bg-blue-100 text-blue-700 rounded-lg">UI/UX</span>
        </div>

    </div>
</x-app-layout>
