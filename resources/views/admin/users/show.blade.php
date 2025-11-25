@extends('layouts.admin')

@section('title', 'Detail User')

@section('content')
    <div class="bg-white p-4 rounded shadow space-y-6">
        <h2 class="font-semibold mb-2">Detail User</h2>

        {{-- INFO DASAR --}}
        <div>
            <p><strong>Nama:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Role:</strong> {{ $user->role ?? 'mahasiswa' }}</p>
        </div>

        @if($user->role === 'mahasiswa')
            {{-- ======== TAMPILAN DETAIL MAHASISWA (internal, bukan public) ======== --}}
            <div>
                <h3 class="font-semibold mb-2">Profil Mahasiswa</h3>
                @if($user->profile)
                    <p><strong>Username:</strong> {{ $user->profile->username }}</p>
                    <p><strong>Headline:</strong> {{ $user->profile->headline }}</p>
                    <p><strong>Bio:</strong> {{ $user->profile->bio }}</p>
                @else
                    <p class="text-gray-500 text-sm">Belum mengisi profil.</p>
                @endif
            </div>

            <div>
                <h3 class="font-semibold mb-2">Keahlian</h3>
                @if($user->skills->count())
                    <ul class="flex flex-wrap gap-2">
                        @foreach($user->skills as $skill)
                            <li class="px-2 py-1 bg-indigo-50 text-indigo-700 rounded-full text-xs">
                                {{ $skill->name }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 text-sm">Belum menambahkan keahlian.</p>
                @endif
            </div>

            <div>
                <h3 class="font-semibold mb-2">Portofolio</h3>
                @if($user->portfolios->count())
                    <ul class="list-disc list-inside space-y-1 text-sm">
                        @foreach($user->portfolios as $p)
                            <li>
                                <strong>{{ $p->title }}</strong>
                                @if($p->link)
                                    - <a href="{{ $p->link }}" target="_blank" class="text-indigo-600 underline">Lihat</a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 text-sm">Belum menambahkan portofolio.</p>
                @endif
            </div>
        @else
            {{-- ======== TAMPILAN UNTUK USER ROLE ADMIN ======== --}}
            <div class="border-t pt-4">
                <h3 class="font-semibold mb-2">Admin Account</h3>
                <p class="text-sm text-gray-600">
                    Akun ini adalah admin, tidak memiliki data profil mahasiswa, keahlian, maupun portofolio.
                </p>

                <div class="mt-3">
                    <a href="{{ route('admin.jobs.index') }}"
                       class="inline-block text-xs px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        Kelola Lowongan Pekerjaan
                    </a>
                </div>
            </div>
        @endif

        <div class="pt-4 border-t flex gap-3">
            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-sm text-red-600 hover:underline">
                    Hapus User
                </button>
            </form>
        </div>
    </div>
@endsection
