@extends('layouts.admin')

@section('title', 'Edit Lowongan')

@section('content')

<div class="bg-white shadow-lg rounded-xl p-6 border border-gray-100">
    

    <form action="{{ route('admin.jobs.update', $job) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        {{-- Jabatan --}}
        <div>
            <label class="block text-sm font-medium mb-1">Posisi / Jabatan</label>
            <input type="text" name="title" value="{{ old('title', $job->title) }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
            @error('title') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Nama Perusahaan --}}
        <div>
            <label class="block text-sm font-medium mb-1">Nama Perusahaan</label>
            <input type="text" name="company_name" value="{{ old('company_name', $job->company_name) }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
        </div>

        {{-- Logo --}}
        <div>
            <label class="block text-sm font-medium mb-1">Logo Perusahaan (opsional)</label>

            @php
                if ($job->company_logo) {
                    // Kalau logo adalah URL (ui-avatars or external image)
                    if (Str::startsWith($job->company_logo, ['http://', 'https://'])) {
                        $logoEdit = $job->company_logo;
                    } 
                    // Kalau logo adalah path lokal
                    else {
                        $logoEdit = asset('storage/'.$job->company_logo);
                    }
                } else {
                    // fallback avatar
                    $logoEdit = 'https://ui-avatars.com/api/?name=' . urlencode($job->company_name) . '&size=100&background=3b82f6&color=fff';
                }
            @endphp

            @if($logoEdit)
                <img src="{{ $logoEdit }}" alt="Logo"
                    class="h-14 mb-2 object-contain rounded-lg">
            @endif

            <label
                class="flex items-center gap-2 px-4 py-2 bg-white text-indigo-600 border border-indigo-600 rounded-lg cursor-pointer
                    hover:bg-indigo-600 hover:text-white active:bg-indigo-700 transition w-max text-sm font-medium shadow-sm">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                        d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M4 8v8m16-8v8M12 4v12m0-12L8 8m4-4l4 4" />
                </svg>

                Pilih Logo

                <input type="file" name="company_logo" class="hidden"
                    onchange="document.getElementById('logo-name').textContent = this.files[0]?.name || ''">
            </label>

            <p id="logo-name" class="text-xs text-gray-600 mt-2"></p>
        </div>


        {{-- Lokasi + Tipe kerja --}}
        <div class="grid md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium mb-1">Lokasi</label>
                <input type="text" name="location" value="{{ old('location', $job->location) }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Tipe Pekerjaan</label>
                <input type="text" name="employment_type" value="{{ old('employment_type', $job->employment_type) }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
            </div>
        </div>

        {{-- Deadline --}}
        <div>
            <label class="block text-sm font-medium mb-1">Deadline (opsional)</label>
            <input type="date" name="deadline"
                value="{{ old('deadline', optional($job->deadline)->format('Y-m-d')) }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
        </div>

        {{-- Link Pendaftaran --}}
        <div>
            <label class="block text-sm font-medium mb-1">Link Pendaftaran (opsional)</label>
            <input type="url" name="apply_link" value="{{ old('apply_link', $job->apply_link) }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
        </div>

        {{-- Deskripsi --}}
        <div>
            <label class="block text-sm font-medium mb-1">Deskripsi Singkat</label>
            <textarea name="description" rows="3"
                class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">{{ old('description', $job->description) }}</textarea>
        </div>

        {{-- Requirements --}}
        <div>
            <label class="block text-sm font-medium mb-1">Requirement / Skill yang Dibutuhkan</label>
            <textarea name="requirements" rows="4"
                class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">{{ old('requirements', $job->requirements) }}</textarea>
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end gap-3 pt-4 border-t">
            <a href="{{ route('admin.jobs.index') }}"
                class="flex items-center gap-2 px-4 py-2 bg-white text-indigo-600 border border-indigo-600 rounded-lg cursor-pointer
                   hover:bg-indigo-600 hover:text-white active:bg-indigo-700 transition w-max text-sm font-medium shadow-sm">
                Batal
            </a>

            <button type="submit"
                class="px-5 py-2.5 bg-indigo-600 text-white text-sm rounded-lg hover:bg-indigo-700 transition font-medium shadow">
                Simpan
            </button>
        </div>
    </form>
</div>

@endsection
