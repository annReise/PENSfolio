@extends('layouts.admin')

@section('title', 'Kelola Lowongan')

@section('content')

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="mb-4 px-4 py-3 bg-green-100 text-green-700 border border-green-300 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- Header --}}
<div class="flex justify-end items-center mb-6">

    <a href="{{ route('admin.jobs.create') }}"
       class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow hover:bg-indigo-700 transition flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-width="2" stroke-linejoin="round"
                  d="M12 4v16m8-8H4" />
        </svg>
        Tambah Lowongan
    </a>
</div>


    {{-- CONTENT CARD --}}
    <div class="bg-white rounded-xl shadow p-6">

        <table class="w-full">
            <thead class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wide">
                <tr>
                    <th class="px-6 py-3 text-left">Posisi</th>
                    <th class="px-6 py-3 text-left">Perusahaan</th>
                    <th class="px-6 py-3 text-left">Lokasi</th>
                    <th class="px-6 py-3 text-left">Deadline</th>
                    <th class="px-6 py-3 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($jobs as $job)
                    <tr class="hover:bg-gray-50">

                        {{-- POSISI --}}
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">
    {{ $job->title }}
</td>

                        {{-- PERUSAHAAN --}}
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ $job->company_name }}
                        </td>

                        {{-- LOKASI --}}
                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ $job->location ?? '-' }}
                        </td>

                        {{-- DEADLINE --}}
                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ $job->deadline ? $job->deadline->format('d M Y') : '-' }}
                        </td>

                        {{-- AKSI --}}
                        <td class="px-6 py-4 text-sm flex gap-4 items-center">

                            {{-- EDIT BUTTON --}}
<a href="{{ route('admin.jobs.edit', $job) }}"
   class="text-blue-600 hover:text-blue-700 flex items-center gap-1 font-medium">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L7.5 21H3v-4.5l13.732-13.732z" />
    </svg>
    Edit
</a>

                            {{-- DELETE --}}
<form action="{{ route('admin.jobs.destroy', $job) }}"
      method="POST"
      onsubmit="return confirm('Yakin ingin menghapus lowongan ini?')">
    @csrf
    @method('DELETE')

    <button type="submit"
        class="text-red-600 hover:text-red-700 flex items-center gap-1 font-medium">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>

        Hapus
    </button>
</form>

                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-6 text-center text-gray-500">
                            Belum ada lowongan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-5">
            {{ $jobs->links() }}
        </div>

    </div>

@endsection
