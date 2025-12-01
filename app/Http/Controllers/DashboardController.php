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

         $students = User::with(['profile', 'skills'])
            ->where('id', '!=', $user->id)
            ->where('role', 'mahasiswa')
            ->whereHas('profile')
            ->orderBy('name')
            ->get();

        return view('dashboard', [
            'user'           => $user,
            'profile'        => $profile,
            'portfolioCount' => $portfolioCount,
            'skillCount'     => $skillCount,
            'students'       => $students,
        ]);

    }

    public function adminIndex()
    {
        // Semua mahasiswa dengan relasi profile, skills, portfolios
        $students = User::with(['profile', 'skills', 'portfolios'])
            ->where('role', 'student')
            ->orderBy('name')
            ->paginate(20);

        // Bisa juga hitung total user, total portfolio dll
        $totalStudents   = User::where('role', 'student')->count();
        $totalPortfolios = \App\Models\Portfolio::count();

        return view('admin.dashboard', [
            'students'       => $students,
            'totalStudents'  => $totalStudents,
            'totalPortfolios'=> $totalPortfolios,
        ]);
    }
}