<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Full Time Jobs (5)
        Job::factory()
            ->count(5)
            ->fullTime()
            ->create();

        // 2. Internship (5)
        Job::factory()
            ->count(5)
            ->internship()
            ->create();

        // 3. Part Time (5)
        Job::factory()
            ->count(5)
            ->partTime()
            ->create();

        // 4. Freelance (5)
        Job::factory()
            ->count(5)
            ->freelance()
            ->create();

        // 5. Remote Jobs (5)
        Job::factory()
            ->count(5)
            ->remote()
            ->fullTime()
            ->create();
       
        $this->command->info('✅ Berhasil membuat ' . Job::count() . ' job listings!');
    }
}