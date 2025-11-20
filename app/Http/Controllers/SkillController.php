<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SkillController extends Controller
{
    /**
     * Tampilkan daftar skill milik user yang login.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        // Ambil semua skill yang sudah di-attach ke user
        $skills = $user->skills()->orderBy('name')->get();

        return view('skills.index', compact('skills', 'user'));
    }

    /**
     * Form tambah skill baru (attach ke user).
     */
    public function create(): View
    {
        return view('skills.create');
    }

    /**
     * Simpan skill baru (atau attach skill existing) ke user.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'category' => ['nullable', 'string', 'max:100'],
        ]);

        $user = $request->user();

        // Cari jika skill dengan nama sama sudah ada, kalau tidak buat baru
        $skill = Skill::firstOrCreate(
            ['name' => $validated['name']],
            ['category' => $validated['category'] ?? null]
        );

        // Attach ke user (hindari duplikat)
        if (! $user->skills()->where('skills.id', $skill->id)->exists()) {
            $user->skills()->attach($skill->id);
        }

        return redirect()
            ->route('skills.index')
            ->with('success', 'Skill berhasil ditambahkan.');
    }

    /**
     * Form edit skill milik user.
     */
    public function edit(Request $request, Skill $skill): View
    {
        $user = $request->user();

        // Pastikan skill ini terhubung ke user
        if (! $user->skills()->where('skills.id', $skill->id)->exists()) {
            abort(403, 'Anda tidak berhak mengedit skill ini.');
        }

        return view('skills.edit', compact('skill'));
    }

    /**
     * Update skill master (nama & kategori).
     */
    public function update(Request $request, Skill $skill): RedirectResponse
    {
        $user = $request->user();

        if (! $user->skills()->where('skills.id', $skill->id)->exists()) {
            abort(403, 'Anda tidak berhak mengupdate skill ini.');
        }

        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'category' => ['nullable', 'string', 'max:100'],
        ]);

        $skill->update($validated);

        return redirect()
            ->route('skills.index')
            ->with('success', 'Skill berhasil diupdate.');
    }

    /**
     * Lepas skill dari user (detach), tanpa menghapus dari tabel master skills.
     */
    public function destroy(Request $request, Skill $skill): RedirectResponse
    {
        $user = $request->user();

        if (! $user->skills()->where('skills.id', $skill->id)->exists()) {
            abort(403, 'Anda tidak berhak menghapus skill ini.');
        }

        $user->skills()->detach($skill->id);

        return redirect()
            ->route('skills.index')
            ->with('success', 'Skill berhasil dihapus dari profil Anda.');
    }
}
