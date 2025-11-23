<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\PublicProfileController;

/*
|--------------------------------------------------------------------------
| Public routes (guest & public profile)
|--------------------------------------------------------------------------
*/

// Redirect root ke dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Halaman profil publik per-username, misal: /u/demouser
Route::get('/u/{username}', [PublicProfileController::class, 'show'])
    ->name('public.profile');

/*
|--------------------------------------------------------------------------
| Authenticated routes (harus login & verified)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // PROFILE (halaman internal user)
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.index');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    // PORTFOLIO CRUD
    Route::resource('portfolio', PortfolioController::class);

    // SKILLS CRUD (tanpa show)
    Route::resource('skills', SkillController::class)->except(['show']);
});

// Route publik & user biasa kamu (dashboard, profile, portfolio, skills, dll)
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminJobController;
use App\Http\Middleware\EnsureUserIsAdmin;


// Group khusus admin
Route::middleware(['auth', 'verified', EnsureUserIsAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // Kelola user (mahasiswa)
        Route::get('/users', [AdminUserController::class, 'index'])
            ->name('users.index');

        Route::get('/users/{user}', [AdminUserController::class, 'show'])
            ->name('users.show');

        // (opsional) hapus user
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])
            ->name('users.destroy');

        // CRUD lowongan
        // Route::resource('jobs', AdminJobController::class);
        // LOWONGAN - CRUD oleh admin
        Route::get('/jobs', [AdminJobController::class, 'index'])->name('jobs.index');
        Route::get('/jobs/create', [AdminJobController::class, 'create'])->name('jobs.create');
        Route::post('/jobs', [AdminJobController::class, 'store'])->name('jobs.store');
        Route::get('/jobs/{job}/edit', [AdminJobController::class, 'edit'])->name('jobs.edit');
        Route::put('/jobs/{job}', [AdminJobController::class, 'update'])->name('jobs.update');
        Route::delete('/jobs/{job}', [AdminJobController::class, 'destroy'])->name('jobs.destroy');
    });

use App\Http\Controllers\JobController;

Route::middleware(['auth', 'verified'])->group(function () {
    // ... route lain ...

    Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
});

// Route auth dari Breeze (login, register, dll)
require __DIR__.'/auth.php';
