@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    @if(session('success'))
        <div class="mb-4 px-4 py-2 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-gray-500">Total User</p>
            <p class="text-3xl font-bold">{{ $totalUsers }}</p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-gray-500">Admin</p>
            <p class="text-3xl font-bold">{{ $totalAdmins }}</p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-gray-500">Mahasiswa</p>
            <p class="text-3xl font-bold">{{ $totalMahasiswa }}</p>
        </div>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h2 class="font-semibold mb-3">User Terbaru</h2>
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b">
                    <th class="text-left py-2">Nama</th>
                    <th class="text-left py-2">Email</th>
                    <th class="text-left py-2">Role</th>
                    <th class="text-left py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                    <tr class="border-b">
                        <td class="py-2">{{ $u->name }}</td>
                        <td class="py-2">{{ $u->email }}</td>
                        <td class="py-2 capitalize">{{ $u->role ?? 'mahasiswa' }}</td>
                        <td class="py-2">
                            <a href="{{ route('admin.users.show', $u) }}"
                               class="text-indigo-600 hover:underline text-xs">
                                Detail
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
