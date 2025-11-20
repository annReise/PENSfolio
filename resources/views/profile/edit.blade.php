<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow">

        <h1 class="text-2xl font-bold mb-4">Edit Profil</h1>

        <form>

            <div class="mb-4">
                <label class="font-semibold">Foto Profil</label>
                <input type="file" class="w-full p-3 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="font-semibold">Nama Lengkap</label>
                <input type="text" class="w-full p-3 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="font-semibold">Tentang Saya</label>
                <textarea class="w-full p-3 border rounded-lg" rows="5"></textarea>
            </div>

            <button class="px-6 py-3 bg-yellow-600 text-white rounded-lg">
                Simpan Perubahan
            </button>

        </form>

    </div>
</x-app-layout>
