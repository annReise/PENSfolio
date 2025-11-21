<x-app-layout>
    <div class="max-w-md mx-auto py-10">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-xl font-semibold mb-4">Ubah Password</h1>

            @if(session('status') === 'password-updated')
                <div class="mb-4 text-green-700 bg-green-100 border border-green-300 px-4 py-2 rounded">
                    Password berhasil diperbarui.
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <x-input-label for="current_password" value="Password Lama" />
                    <x-text-input id="current_password"
                                  type="password"
                                  name="current_password"
                                  class="mt-1 block w-full"
                                  autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="password" value="Password Baru" />
                    <x-text-input id="password"
                                  type="password"
                                  name="password"
                                  class="mt-1 block w-full"
                                  autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="password_confirmation" value="Konfirmasi Password Baru" />
                    <x-text-input id="password_confirmation"
                                  type="password"
                                  name="password_confirmation"
                                  class="mt-1 block w-full"
                                  autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <x-primary-button>
                    Simpan Password
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
