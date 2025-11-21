<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'demo@example.com')->first();

        if (! $user) {
            return;
        }

        Portfolio::firstOrCreate(
            [
                'user_id' => $user->id,
                'title'   => 'Sistem Portofolio Mahasiswa',
            ],
            [
                'description' => 'Aplikasi web untuk menampilkan portofolio dan keahlian mahasiswa.',
                'link'        => 'https://github.com/example/portofolio',
                'image'       => null,
            ]
        );
    }
}
