<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow">
        <h1 class="text-2xl font-bold mb-4">Tambah Skill</h1>

        <form action="{{ route('skills.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="font-semibold">Nama Skill</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full p-3 border rounded-lg @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="font-semibold">Kategori (opsional)</label>
                <input type="text" name="category" value="{{ old('category') }}"
                       class="w-full p-3 border rounded-lg @error('category') border-red-500 @enderror">
                @error('category')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

           
    <button type="submit"
    class="mt-4 px-5 py-2 bg-blue-900 text-white font-medium border border-blue-900 rounded-md
           hover:bg-blue-800 active:bg-blue-950 transition">
    Simpan
</button>
        </form>
    </div>
</x-app-layout>
