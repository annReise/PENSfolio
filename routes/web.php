<?php

use Illuminate\Support\Facades\Route;

// HOME
Route::get('/', function () {
    return view('dashboard');
});

// DASHBOARD
Route::view('/dashboard', 'dashboard')->name('dashboard');

// PORTFOLIO
Route::view('/portfolio', 'portfolio.index')->name('portfolio.index');
Route::view('/portfolio/create', 'portfolio.create')->name('portfolio.create'); // <-- dulu ketabrak
Route::view('/portfolio/{id}/edit', 'portfolio.edit')->name('portfolio.edit');   // <-- letakkan sebelum /{id}
Route::view('/portfolio/{id}', 'portfolio.show')->name('portfolio.show');        // <-- dinamis paling bawah

// SKILLS
Route::view('/skills', 'skills.index')->name('skills.index');
Route::view('/skills/create', 'skills.create')->name('skills.create');

// PROFILE
Route::view('/profile', 'profile.index')->name('profile.index');
Route::view('/profile/edit', 'profile.edit')->name('profile.edit');

// PUBLIC PROFILE
Route::view('/u/{username}', 'public.profile')->name('public.profile');
