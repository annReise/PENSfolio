<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::with(['profile', 'skills'])->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load(['profile', 'skills', 'portfolios']);

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'User berhasil dihapus.');
    }
}
