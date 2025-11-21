@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('subtitle', 'Ringkasan mahasiswa & portofolio')

@section('content')
    {{-- Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow p-4">
            <p class="text-xs text-gray-500">Total Mahasiswa</p>
            <p class="text-2xl font-bold">{{ $totalStudents }}</p>
        </div>
        <div class="bg-white rounded-xl shadow p-4">
            <p class="text-xs text-gray-500">Total Portofolio</p>
            <p class="text-2xl font-bold">{{ $totalPortfolios }}</p>
        </div>
        {{-- slot stats lain kalau mau --}}
    </div>

    {{-- Tabel mahasiswa --}}
    <div class="bg-white rounded-xl shadow p-4">
        <h2 class="text-lg font-semibold mb-4">Daftar Mahasiswa</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-3 py-2 text-left">Nama</th>
                        <th class="px-3 py-2 text-left">Username</th>
                        <th class="px-3 py-2 text-left">Email</th>
                        <th class="px-3 py-2 text-left">Keahlian</th>
                        <th class="px-3 py-2 text-left"># Portofolio</th>
                        <th class="px-3 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        @php
                            $profile = $student->profile;
                        @endphp
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-3 py-2">
                                {{ $student->name }}
                            </td>
                            <td class="px-3 py-2">
                                {{ $profile?->username ?? '-' }}
                            </td>
                            <td class="px-3 py-2">
                                {{ $student->email }}
                            </td>
                            <td class="px-3 py-2 max-w-xs">
                                @if($student->skills->count())
                                    <div class="flex flex-wrap gap-1">
                                        @foreach ($student->skills as $skill)
                                            <span class="px-2 py-0.5 bg-blue-100 text-blue-700 rounded-full text-xs">
                                                {{ $skill->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-gray-400 text-xs">Belum ada</span>
                                @endif
                            </td>
                            <td class="px-3 py-2">
                                {{ $student->portfolios->count() }}
                            </td>
                            <td class="px-3 py-2">
                                @if ($profile?->username)
                                    <a href="{{ route('public.profile', $profile->username) }}"
                                       target="_blank"
                                       class="text-xs px-3 py-1 bg-indigo-600 text-white rounded-md hover:bg-indigo-500">
                                        Lihat Profil Publik
                                    </a>
                                @else
                                    <span class="text-gray-400 text-xs">Belum ada profil</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-3 py-4 text-center text-gray-500">
                                Belum ada data mahasiswa.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $students->links() }}
        </div>
    </div>
@endsection
