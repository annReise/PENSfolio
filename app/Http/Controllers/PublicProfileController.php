<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class PublicProfileController extends Controller
{
    public function show(string $username)
    {
        $profile = Profile::with(['user.portfolios', 'user.skills'])
            ->where('username', $username)
            ->firstOrFail();

        $user       = $profile->user;
        $portfolios = $user->portfolios;
        $skills     = $user->skills;

        return view('public.profile', compact('profile', 'user', 'portfolios', 'skills'));
    }
}
