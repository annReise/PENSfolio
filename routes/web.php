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

// Route auth dari Breeze (login, register, dll)
require __DIR__.'/auth.php';
