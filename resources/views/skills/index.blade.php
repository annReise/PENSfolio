<x-app-layout>
    <div class="max-w-4xl mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Keahlian Saya</h1>
            <a href="{{ route('skills.create') }}"
               class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                + Tambah Skill
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if ($skills->isEmpty())
            <p class="text-gray-600">Belum ada skill. Yuk tambahkan minimal satu skill 😊</p>
        @else
            <div class="flex flex-wrap gap-3">
                @foreach ($skills as $skill)
                    <div class="flex items-center gap-2 px-3 py-2 bg-blue-50 rounded-full">
                        <span class="font-medium text-blue-800">{{ $skill->name }}</span>
                        @if ($skill->category)
                            <span class="text-xs text-gray-500">({{ $skill->category }})</span>
                        @endif

                        <a href="{{ route('skills.edit', $skill) }}" class="text-xs text-blue-600">Edit</a>

                        <form action="{{ route('skills.destroy', $skill) }}"
                              method="POST"
                              onsubmit="return confirm('Hapus skill ini dari profil Anda?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-red-600">Hapus</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
