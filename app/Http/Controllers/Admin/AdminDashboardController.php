<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers      = User::count();
        $totalAdmins     = User::where('role', 'admin')->count();
        $totalMahasiswa  = User::where('role', 'mahasiswa')->count();
        $recentUsers     = User::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAdmins',
            'totalMahasiswa',
            'recentUsers'
        ));
    }
}
