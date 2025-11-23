{{-- resources/views/profile/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Profil Saya
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 text-green-700 bg-green-100 border border-green-300 px-4 py-2 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6 grid md:grid-cols-3 gap-6">
                {{-- Avatar --}}
                <div class="flex flex-col items-center">
                    @if ($profile && $profile->avatar)
                        <img
                            src="{{ asset('storage/' . $profile->avatar) }}"
                            alt="Avatar"
                            class="w-32 h-32 rounded-full object-cover mb-3"
                        >
                    @else
                        <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center mb-3">
                            <span class="text-gray-500 text-sm">No Avatar</span>
                        </div>
                    @endif

                    <p class="font-semibold">{{ $user->name }}</p>
                    @if ($profile && $profile->headline)
                        <p class="text-sm text-gray-600 text-center mt-1">
                            {{ $profile->headline }}
                        </p>
                    @endif

                    <a
                        href="{{ route('profile.edit') }}"
                        class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600  border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    >
                        Edit Profil
                    </a>
                </div>

                {{-- Bio + Sosial Link --}}
                <div class="md:col-span-2 space-y-4">
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-1">Bio</h3>
                        <p class="text-sm text-gray-700">
                            {{ $profile && $profile->bio ? $profile->bio : 'Belum ada bio.' }}
                        </p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-gray-800 mb-1">Kontak & Sosial Media</h3>
                        <ul class="text-sm text-indigo-700 space-y-1">
                            @if ($profile && $profile->website)
                                <li>
                                    Website:
                                    <a href="{{ $profile->website }}" target="_blank" class="underline">
                                        {{ $profile->website }}
                                    </a>
                                </li>
                            @endif

                            @if ($profile && $profile->linkedin)
                                <li>
                                    LinkedIn:
                                    <a href="{{ $profile->linkedin }}" target="_blank" class="underline">
                                        {{ $profile->linkedin }}
                                    </a>
                                </li>
                            @endif

                            @if ($profile && $profile->github)
                                <li>
                                    GitHub:
                                    <a href="{{ $profile->github }}" target="_blank" class="underline">
                                        {{ $profile->github }}
                                    </a>
                                </li>
                            @endif

                            @if (!($profile && ($profile->website || $profile->linkedin || $profile->github)))
                                <li class="text-gray-500">
                                    Belum ada link yang diisi.
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
