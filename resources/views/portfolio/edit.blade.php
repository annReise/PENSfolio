<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow">

        <h1 class="text-2xl font-bold mb-4">Edit Portofolio</h1>

        <form method="POST"
              action="{{ route('portfolio.update', $portfolio) }}"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="font-semibold">Nama Proyek</label>
                <input type="text" name="title"
                       value="{{ old('title', $portfolio->title) }}"
                       class="w-full p-3 border rounded-lg">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="font-semibold">Deskripsi</label>
                <textarea name="description" rows="5"
                          class="w-full p-3 border rounded-lg">{{ old('description', $portfolio->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="font-semibold">Link Proyek (opsional)</label>
                <input type="text" name="link"
                       value="{{ old('link', $portfolio->link) }}"
                       class="w-full p-3 border rounded-lg">
                @error('link')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="font-semibold">Gambar Thumbnail</label>

                @if($portfolio->image)
                    <img src="{{ asset('storage/'.$portfolio->image) }}"
                         class="w-full max-w-xs rounded mb-2">
                @endif

                <input type="file" name="image"
                       class="w-full p-3 border rounded-lg">
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button class="px-6 py-3 bg-blue-600 text-white rounded-lg">
                Simpan
            </button>
        </form>

    </div>
</x-app-layout>
