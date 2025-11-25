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
        $users = User::latest()->paginate(10);

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAdmins',
            'totalMahasiswa',
            'users'
        ));
    }
}
