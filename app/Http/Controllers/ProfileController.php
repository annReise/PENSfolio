<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Tampilkan ringkasan profil (internal).
     */
    public function index()
    {
         /** @var User $user */
        $user = auth()->user();
        $profile = $user->profile;

        return view('profile.index', [
            'user'    => $user,
            'profile' => $profile,
        ]);
    }

    /**
     * Form edit profil.
     */
    public function edit()
    {
        /** @var User $user */
        $user = auth()->user();
        $profile = $user->profile ?? new Profile();

        return view('profile.edit', [
            'user'    => $user,
            'profile' => $profile,
        ]);
    }

    /**
     * Simpan perubahan profil (username, headline, bio, avatar, link, dll).
     */
    public function update(Request $request)
    {
        $user = auth()->user();
        $profile = $user->profile;

        $validated = $request->validate([
            'username' => 'required|string|max:50|unique:profiles,username,' . optional($profile)->id,
            'headline' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:100',
            'bio'      => 'nullable|string',
            'website'  => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'github'   => 'nullable|url|max:255',
            'avatar'   => 'nullable|image|max:2048',
        ]);

        $avatarPath = $profile->avatar ?? null;

        if ($request->hasFile('avatar')) {
            if ($avatarPath && Storage::disk('public')->exists($avatarPath)) {
                Storage::disk('public')->delete($avatarPath);
            }
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        $profileData = [
            'username' => $validated['username'],
            'headline' => $validated['headline'] ?? null,
            'department' => $validated['department'] ?? null,
            'bio'      => $validated['bio'] ?? null,
            'website'  => $validated['website'] ?? null,
            'linkedin' => $validated['linkedin'] ?? null,
            'github'   => $validated['github'] ?? null,
            'avatar'   => $avatarPath,
        ];

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $profileData
        );

        return redirect()
            ->route('profile.index')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
