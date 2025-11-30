<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow">

        <h1 class="text-2xl font-bold mb-4">Tambah Portofolio</h1>

        <form method="POST"
              action="{{ route('portfolio.store') }}"
              enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="font-semibold">Nama Portfolio</label>
                <input type="text" name="title" value="{{ old('title') }}"
                       class="w-full p-3 border rounded-lg">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="font-semibold">Deskripsi</label>
                <textarea name="description" rows="5"
                          class="w-full p-3 border rounded-lg">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="font-semibold">Link Portfolio (opsional)</label>
                <input type="text" name="link" value="{{ old('link') }}"
                       class="w-full p-3 border rounded-lg">
                @error('link')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

<div class="mt-4 mb-6">
   <label class="block font-semibold mb-1">Gambar Portfolio (opsional)</label>
    <label
    class="flex items-center gap-2 px-4 py-2 bg-blue-900 text-white border border-blue-900 rounded-md cursor-pointer
           hover:bg-blue-800 active:bg-blue-950 transition w-max text-sm font-medium shadow-sm mt-2">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
              d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M4 8v8m16-8v8M12 4v12m0-12L8 8m4-4l4 4" />
    </svg>
    Pilih Gambar
    <input type="file" name="image" class="hidden">
</label>


<span id="file-name" class="text-sm text-gray-600 ml-1"></span>
</div>



    <button type="submit"
    class="mt-4 px-5 py-2 bg-blue-900 text-white font-medium border border-blue-900 rounded-md
           hover:bg-blue-800 active:bg-blue-950 transition">
    Simpan
</button>

        </form>

    </div>

    <script>
document.querySelectorAll('input[type="file"]').forEach(input => {
    input.addEventListener('change', function () {
        const name = this.files[0] ? this.files[0].name : '';
        this.closest('label').nextElementSibling?.remove();
        
        const span = document.createElement('span');
        span.className = 'text-sm text-gray-600 ml-1 block mt-1';
        span.textContent = name;

        this.closest('label').after(span);
    });
});
</script>

</x-app-layout>
