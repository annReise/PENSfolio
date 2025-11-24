@extends('layouts.admin')

@section('title', 'Daftar Mahasiswa')

@section('content')
    <div class="bg-white p-4 rounded shadow">
        <h2 class="font-semibold mb-4">Semua User</h2>

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
                        <td class="py-2">
                            @if($u->profile?->username)
                                <a href="{{ route('public.profile', $u->profile->username) }}"
                                class="text-indigo-600 hover:underline">
                                    {{ $u->name }}
                                </a>
                            @else
                                {{ $u->name }}
                            @endif
                        </td>
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

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
@endsection
