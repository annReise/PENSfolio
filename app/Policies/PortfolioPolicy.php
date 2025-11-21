<?php

namespace App\Policies;

use App\Models\Portfolio;
use App\Models\User;

class PortfolioPolicy
{
    /**
     * Hanya pemilik portfolio yang boleh lihat detail (jika ini halaman private).
     * Kalau nanti ada halaman public, bisa disesuaikan.
     */
    public function view(User $user, Portfolio $portfolio): bool
    {
        return $portfolio->user_id === $user->id;
    }

    /**
     * Boleh update kalau pemilik.
     */
    public function update(User $user, Portfolio $portfolio): bool
    {
        return $portfolio->user_id === $user->id;
    }

    /**
     * Boleh delete kalau pemilik.
     */
    public function delete(User $user, Portfolio $portfolio): bool
    {
        return $portfolio->user_id === $user->id;
    }
}
