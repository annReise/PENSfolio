<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow">

        <h1 class="text-2xl font-bold mb-4">Tambah Portofolio</h1>

        <form method="POST"
              action="{{ route('portfolio.store') }}"
              enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="font-semibold">Nama Proyek</label>
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
                <label class="font-semibold">Link Proyek (opsional)</label>
                <input type="text" name="link" value="{{ old('link') }}"
                       class="w-full p-3 border rounded-lg">
                @error('link')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

<div class="mt-4">
        <label class="block text-sm font-medium text-gray-700" for="image">Gambar (opsional)</label>
        <input
            id="image"
            type="file"
            name="image"
            class="mt-1 block w-full text-sm text-gray-700"
        >
        <x-input-error :messages="$errors->get('image')" class="mt-2" />
    </div>

    <x-primary-button class="mt-4">
        Simpan
    </x-primary-button>
        </form>

    </div>
</x-app-layout>
