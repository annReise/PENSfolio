<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow">

        <h1 class="text-2xl font-bold mb-4">Tambah Portofolio</h1>

        <form method="POST" action="{{ route('portfolio.store') }}" enctype="multipart/form-data">
    @csrf
    {{-- isi input sama seperti punyamu, tambahkan name="title" dll --}}
</form>


            <div class="mb-4">
                <label class="font-semibold">Deskripsi</label>
                <textarea class="w-full p-3 border rounded-lg" rows="5"></textarea>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Link Proyek (opsional)</label>
                <input type="text" class="w-full p-3 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="font-semibold">Gambar Thumbnail</label>
                <input type="file" class="w-full p-3 border rounded-lg">
            </div>

            <button class="px-6 py-3 bg-blue-600 text-white rounded-lg">
                Simpan
            </button>
        </form>

    </div>
</x-app-layout>
