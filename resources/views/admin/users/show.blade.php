@extends('layouts.admin')

@section('title', 'Detail User')

@section('content')
    <div class="space-y-6">

        {{-- User Header Card --}}
        <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-xl shadow-xl p-5 text-white">
            <div class="flex items-center gap-6">
                {{-- Avatar --}}
                <div class="bg-white p-1 rounded-xl shadow-lg">
                    @php
                        $avatar = $user->profile?->avatar
                            ? asset('storage/'.$user->profile->avatar)
                            : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&size=150&background=3b82f6&color=fff';
                    @endphp
                    <img src="{{ $avatar }}" alt="{{ $user->name }}"
                         class="w-24 h-24 rounded-lg object-cover">
                </div>

                {{-- User Info --}}
                <div class="flex-1">
                    <h1 class="text-3xl font-bold mb-2">{{ $user->name }}</h1>
                    <p class="text-blue-100 text-lg mb-4">{{ $user->email }}</p>
                    
                    <div class="flex flex-wrap gap-3">
                        {{-- Role Badge --}}
                        <span class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur-sm rounded-lg text-sm font-semibold">
                            @if($user->role === 'admin')
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                                Admin
                            @else
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Mahasiswa
                            @endif
                        </span>

                        {{-- Username Badge (if exists) --}}
                        @if($user->profile?->username)
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur-sm rounded-lg text-sm font-semibold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                </svg>
                                {{ $user->profile->username }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if($user->role === 'mahasiswa')
            {{-- ======== MAHASISWA CONTENT ======== --}}
            
            {{-- Profile Info --}}
            @if($user->profile)
                <div class="bg-white rounded-xl shadow-lg p-6 border-2 border-gray-100">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">Profil Mahasiswa</h2>
                    </div>

                    <div class="space-y-3">
                        @if($user->profile->headline)
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Headline</p>
                                <p class="text-gray-800 font-medium">{{ $user->profile->headline }}</p>
                            </div>
                        @endif

                        @if($user->profile->bio)
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Bio</p>
                                <p class="text-gray-700 leading-relaxed">{{ $user->profile->bio }}</p>
                            </div>
                        @endif

                        @if(!$user->profile->headline && !$user->profile->bio)
                            <p class="text-gray-500 text-sm italic">Belum mengisi profil lengkap.</p>
                        @endif
                    </div>
                </div>
            @else
                <div class="bg-yellow-50 border-2 border-yellow-200 rounded-xl p-6">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <p class="text-yellow-800 font-medium">User belum membuat profil.</p>
                    </div>
                </div>
            @endif

            {{-- Skills --}}
            <div class="bg-white rounded-xl shadow-lg p-6 border-2 border-gray-100">
                <div class="flex items-center gap-3 mb-4">
                    <div class="p-2 bg-indigo-100 rounded-lg">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">Keahlian</h2>
                    <span class="ml-auto text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full font-semibold">
                        {{ $user->skills->count() }} skill
                    </span>
                </div>

                @if($user->skills->count())
                    <div class="flex flex-wrap gap-2">
                        @foreach($user->skills as $skill)
                            <span class="inline-flex items-center gap-1 px-4 py-2 bg-gradient-to-r from-indigo-50 to-purple-50 border-2 border-indigo-200 text-indigo-700 rounded-full text-sm font-semibold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ $skill->name }}
                                @if($skill->category)
                                    <span class="text-xs text-indigo-500">· {{ $skill->category }}</span>
                                @endif
                            </span>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-sm italic">Belum menambahkan keahlian.</p>
                @endif
            </div>

            {{-- Portfolio --}}
            <div class="bg-white rounded-xl shadow-lg p-6 border-2 border-gray-100">
                <div class="flex items-center gap-3 mb-4">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">Portofolio</h2>
                    <span class="ml-auto text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full font-semibold">
                        {{ $user->portfolios->count() }} proyek
                    </span>
                </div>

                @if($user->portfolios->count())
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    @foreach($user->portfolios as $p)
        <div class="p-4 bg-gradient-to-br from-gray-50 to-blue-50 border-2 border-gray-200 rounded-lg hover:shadow-md transition">
            <div class="flex items-start justify-between gap-4">
                <div class="flex-1">
                    <h3 class="font-bold text-gray-800 mb-1">{{ $p->title }}</h3>
                    @if($p->description)
                        <p class="text-sm text-gray-600 mb-2 line-clamp-2">{{ $p->description }}</p>
                    @endif
                    @if($p->link)
                        <a href="{{ $p->link }}" target="_blank"
                           class="inline-flex items-center gap-1 text-sm text-blue-600 hover:text-blue-800 font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            Lihat Proyek
                        </a>
                    @endif
                </div>
                @if($p->image)
                    <img src="{{ asset('storage/'.$p->image) }}" alt="{{ $p->title }}"
                         class="w-20 h-20 rounded-lg object-cover">
                @endif
            </div>
        </div>
    @endforeach
</div>

                @else
                    <p class="text-gray-500 text-sm italic">Belum menambahkan portofolio.</p>
                @endif
            </div>

        @else
            {{-- ======== ADMIN CONTENT ======== --}}
            <div class="bg-white rounded-xl shadow-lg p-8 border-2 border-gray-100">
                <div class="text-center py-8">
                    <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Admin Account</h3>
                    <p class="text-gray-600 mb-6">
                        Akun ini adalah admin, tidak memiliki data profil mahasiswa, keahlian, maupun portofolio.
                    </p>

                    <a href="{{ route('admin.jobs.index') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Kelola Lowongan Pekerjaan
                    </a>
                </div>
            </div>
        @endif

        {{-- Action Buttons --}}
        <div class="bg-white rounded-xl shadow-lg p-6 border-2 border-red-100">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-gray-800 mb-1">Danger Zone</h3>
                    <p class="text-sm text-gray-600">Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                
                <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus user ini? Semua data terkait akan hilang.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Hapus User
                    </button>
                </form>
            </div>
        </div>

    </div>
@endsection