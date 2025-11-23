@extends('layouts.admin')

@section('title', 'Kelola Lowongan')

@section('content')
    @if(session('success'))
        <div class="mb-4 px-4 py-2 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-4">
        <h2 class="font-semibold text-lg">Daftar Lowongan</h2>
        <a href="{{ route('admin.jobs.create') }}"
           class="px-4 py-2 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-700">
            + Tambah Lowongan
        </a>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b">
                    <th class="text-left py-2">Posisi</th>
                    <th class="text-left py-2">Perusahaan</th>
                    <th class="text-left py-2">Lokasi</th>
                    <th class="text-left py-2">Deadline</th>
                    <th class="text-left py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jobs as $job)
                    <tr class="border-b">
                        <td class="py-2">{{ $job->title }}</td>
                        <td class="py-2">{{ $job->company_name }}</td>
                        <td class="py-2">{{ $job->location ?? '-' }}</td>
                        <td class="py-2">
                            {{ $job->deadline ? $job->deadline->format('d M Y') : '-' }}
                        </td>
                        <td class="py-2 flex gap-2">
                            <a href="{{ route('admin.jobs.edit', $job) }}"
                               class="text-xs text-indigo-600 hover:underline">
                                Edit
                            </a>
                            <form action="{{ route('admin.jobs.destroy', $job) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus lowongan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-xs text-red-600 hover:underline">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 text-center text-gray-500 text-sm">
                            Belum ada lowongan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $jobs->links() }}
        </div>
    </div>
@endsection
