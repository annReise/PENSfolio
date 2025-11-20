<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil semua seeder yang kamu buat
        $this->call([
            DemoUserSeeder::class,
            SkillSeeder::class,
            PortfolioSeeder::class,
        ]);
    }
}
