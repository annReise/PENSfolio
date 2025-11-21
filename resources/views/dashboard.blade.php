<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">

        <h1 class="text-3xl font-bold mb-2">
            Halo, {{ auth()->user()->name ?? 'Mahasiswa' }} 👋
        </h1>
        
        <p class="text-gray-600 mb-6">
            Kelola portofolio, keahlian, dan profil publikmu di sini.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <a href="{{ route('portfolio.index') }}"
               class="p-6 bg-gradient-to-br from-blue-500 to-blue-700 text-white rounded-xl shadow hover:scale-105 transition block">
                <h2 class="font-bold text-xl mb-2">Portofolio</h2>
                <p>Kelola proyek, tambah gambar, dan tampilkan karya terbaikmu.</p>
            </a>

            <a href="{{ route('skills.index') }}"
               class="p-6 bg-gradient-to-br from-green-500 to-green-700 text-white rounded-xl shadow hover:scale-105 transition block">
                <h2 class="font-bold text-xl mb-2">Keahlian</h2>
                <p>Tambahkan skill teknis maupun soft skill yang kamu miliki.</p>
            </a>

            <a href="{{ route('profile.index') }}"
               class="p-6 bg-gradient-to-br from-yellow-400 to-yellow-600 text-white rounded-xl shadow hover:scale-105 transition block">
                <h2 class="font-bold text-xl mb-2">Profil</h2>
                <p>Edit foto profil, biodata, dan kontak publik.</p>
            </a>

        </div>
    </div>
</x-app-layout>
