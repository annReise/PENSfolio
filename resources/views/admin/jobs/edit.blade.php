@extends('layouts.admin')

@section('title', 'Edit Lowongan')

@section('content')
    <h2 class="font-semibold text-lg mb-4">Edit Lowongan</h2>

    <form action="{{ route('admin.jobs.update', $job) }}" method="POST" enctype="multipart/form-data"
          class="bg-white p-6 rounded shadow space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium mb-1">Posisi/Jabatan</label>
            <input type="text" name="title" value="{{ old('title', $job->title) }}"
                   class="w-full border rounded px-3 py-2 text-sm">
            @error('title') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Nama Perusahaan</label>
            <input type="text" name="company_name" value="{{ old('company_name', $job->company_name) }}"
                   class="w-full border rounded px-3 py-2 text-sm">
            @error('company_name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Logo Perusahaan (opsional)</label>
            @if($job->company_logo)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$job->company_logo) }}"
                         alt="Logo" class="h-12 object-contain">
                </div>
            @endif
            <input type="file" name="company_logo"
                   class="w-full border rounded px-3 py-2 text-sm">
            @error('company_logo') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Lokasi</label>
                <input type="text" name="location" value="{{ old('location', $job->location) }}"
                       class="w-full border rounded px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Tipe Pekerjaan</label>
                <input type="text" name="employment_type" value="{{ old('employment_type', $job->employment_type) }}"
                       class="w-full border rounded px-3 py-2 text-sm">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Deadline (opsional)</label>
            <input type="date" name="deadline"
                   value="{{ old('deadline', optional($job->deadline)->format('Y-m-d')) }}"
                   class="w-full border rounded px-3 py-2 text-sm">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Link Pendaftaran (opsional)</label>
            <input type="url" name="apply_link" value="{{ old('apply_link', $job->apply_link) }}"
                   class="w-full border rounded px-3 py-2 text-sm">
            @error('apply_link') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Deskripsi Singkat</label>
            <textarea name="description" rows="3"
                      class="w-full border rounded px-3 py-2 text-sm">{{ old('description', $job->description) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Requirement / Skill yang Dibutuhkan</label>
            <textarea name="requirements" rows="4"
                      class="w-full border rounded px-3 py-2 text-sm">{{ old('requirements', $job->requirements) }}</textarea>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.jobs.index') }}"
               class="px-4 py-2 text-sm text-gray-600 hover:underline">
                Batal
            </a>
            <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-700">
                Simpan
            </button>
        </div>
    </form>
@endsection
