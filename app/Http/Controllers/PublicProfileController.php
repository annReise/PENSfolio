<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PublicProfileController extends Controller
{
    /**
     * Tampilkan profil publik berdasarkan username.
     * Route: /u/{username}
     */
    public function show(string $username)
    {
        // Ambil user berdasarkan username (bukan id)
        $user = User::where('username', $username)
            ->with([
                'profile',          // 1 : 1
                'portfolios',       // 1 : n
                'skills',           // n : n
            ])
            ->firstOrFail();

        // Ambil profil (bisa null kalau belum diisi)
        $profile    = $user->profile;
        $portfolios = $user->portfolios;
        $skills     = $user->skills;

        return view('public.profile', compact('user', 'profile', 'portfolios', 'skills'));
    }
}
