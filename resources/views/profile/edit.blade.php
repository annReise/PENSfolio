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

            {{-- FOTO PROFIL (dibuat mirip portofolio) --}}
            <div class="mb-4">
                <label class="font-semibold">Foto Profil</label>

                @if ($profile?->avatar)
                    <p class="mt-2 text-sm text-gray-600">Foto sekarang:</p>
                    <img src="{{ asset('storage/'.$profile->avatar) }}"
                         class="w-20 h-20 rounded-full mt-1 mb-2">
                @endif

                <label
                    class="flex items-center gap-2 px-4 py-2 bg-blue-900 text-white border border-blue-900 rounded-md cursor-pointer
                           hover:bg-blue-800 active:bg-blue-950 transition w-max text-sm font-medium shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                              d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M4 8v8m16-8v8M12 4v12m0-12L8 8m4-4l4 4" />
                    </svg>
                    Pilih Foto
                    <input type="file" name="avatar" class="hidden">
                </label>

                <span id="file-name" class="text-sm text-gray-600 ml-1"></span>

                @error('avatar')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="mt-4 px-5 py-2 bg-blue-900 text-white font-medium border border-blue-900 rounded-md
                           hover:bg-blue-800 active:bg-blue-950 transition">
                Simpan Perubahan
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
