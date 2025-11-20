<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        /** @var User $user */
        $user = auth()->user();

        $validated = $request->validate([
            'username' => 'required|string|max:50|unique:profiles,username,' . optional($user->profile)->id,
            'headline' => 'nullable|string|max:255',
            'bio'      => 'nullable|string',
            'website'  => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'github'   => 'nullable|url|max:255',
            'avatar'   => 'nullable|image|max:2048',
        ]);

        // handle avatar upload
        $avatarPath = $user->profile->avatar ?? null;

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        $profileData = [
            'username' => $validated['username'],
            'headline' => $validated['headline'] ?? null,
            'bio'      => $validated['bio'] ?? null,
            'website'  => $validated['website'] ?? null,
            'linkedin' => $validated['linkedin'] ?? null,
            'github'   => $validated['github'] ?? null,
            'avatar'   => $avatarPath,
        ];

        $user->profile()
            ->updateOrCreate(
                ['user_id' => $user->id],
                $profileData
            );

        return redirect()
            ->route('profile.index')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
