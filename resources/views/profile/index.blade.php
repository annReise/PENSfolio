<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow">

        <div class="flex items-center gap-6 mb-6">
            <img src="{{ $profile && $profile->avatar ? asset('storage/'.$profile->avatar) : 'https://via.placeholder.com/120' }}"
                 class="rounded-full w-24 h-24 object-cover">
            <div>
                <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
                <p class="text-gray-600">
                    {{ $profile->headline ?? 'Tambahkan headline di profil Anda' }}
                </p>
                <a href="{{ route('profile.edit') }}" class="text-blue-600">Edit Profil</a>
            </div>
        </div>

        <hr class="my-4">

        <h2 class="font-bold text-xl mb-2">Tentang Saya</h2>
        <p class="text-gray-700">
            {{ $profile->bio ?? 'Belum ada deskripsi. Silakan edit profil untuk menambahkan.' }}
        </p>

    </div>
</x-app-layout>
