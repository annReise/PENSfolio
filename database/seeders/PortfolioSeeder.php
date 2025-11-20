<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil user demo
        $user = User::where('email', 'demo@example.com')->first();

        if (! $user) {
            return;
        }

        // Buat satu data portfolio contoh
        $user->portfolios()->firstOrCreate(
            ['title' => 'Sistem Portofolio Mahasiswa'],
            [
                'description' => 'Aplikasi web untuk menampilkan portofolio dan keahlian mahasiswa berbasis Laravel.',
                'link'        => 'https://github.com/example/portofolio',
                'image'       => null,
            ]
        );
    }
}
