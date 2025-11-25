<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow">

        <h1 class="text-2xl font-bold mb-4">Edit Profil</h1>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="font-semibold">Username (untuk URL publik)</label>
                <input type="text" name="username"
                       value="{{ old('username', $profile?->username) }}"
                       class="w-full p-3 border rounded-lg">
                @error('username')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="font-semibold">Headline</label>
                <input type="text" name="headline"
                       value="{{ old('headline', $profile?->headline) }}"
                       class="w-full p-3 border rounded-lg">
            </div>

            {{-- DEPARTEMEN --}}
            <div class="mb-4">
                <label class="font-semibold">Departemen</label>
                <select name="department" class="w-full p-3 border rounded-lg">
                    <option value="">-- Pilih Departemen --</option>

                    @php
                        $departments = [
                            'Departemen Teknik Elektro',
                            'Departemen Teknik Informatika dan Komputer',
                            'Departemen Teknik Mekanika dan Energi',
                            'Departemen Teknologi Multimedia Kreatif',
                        ];
                        $currentDept = old('department', $profile?->department);
                    @endphp

                    @foreach ($departments as $dept)
                        <option value="{{ $dept }}" {{ $currentDept === $dept ? 'selected' : '' }}>
                            {{ $dept }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Tentang Saya</label>
                <textarea name="bio" class="w-full p-3 border rounded-lg" rows="5">{{ old('bio', $profile?->bio) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="font-semibold">Website</label>
                <input type="url" name="website"
                       value="{{ old('website', $profile?->website) }}"
                       class="w-full p-3 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="font-semibold">LinkedIn</label>
                <input type="url" name="linkedin"
                       value="{{ old('linkedin', $profile?->linkedin) }}"
                       class="w-full p-3 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="font-semibold">GitHub</label>
                <input type="url" name="github"
                       value="{{ old('github', $profile?->github) }}"
                       class="w-full p-3 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="font-semibold">Foto Profil</label>
                <input type="file" name="avatar" class="w-full p-3 border rounded-lg">
                @if ($profile?->avatar)
                    <p class="mt-2 text-sm text-gray-600">Foto sekarang:</p>
                    <img src="{{ asset('storage/'.$profile->avatar) }}" class="w-20 h-20 rounded-full mt-1">
                @endif
            </div>

            <button class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Simpan Perubahan
            </button>

        </form>

    </div>
</x-app-layout>
