<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard utama.
     */
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();

        $portfolioCount = $user->portfolios()->count();
        $skillCount     = $user->skills()->count();
        $profile        = $user->profile;

        return view('dashboard', [
            'user'           => $user,
            'profile'        => $profile,
            'portfolioCount' => $portfolioCount,
            'skillCount'     => $skillCount,
        ]);
    }
}
