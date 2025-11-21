<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoUserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'demo@example.com'],
            [
                'name'     => 'Demo User',
                'password' => Hash::make('password'),
            ]
        );

        $user->profile()->updateOrCreate(
            [],
            [
                'username' => 'demouser',
                'headline' => 'Mahasiswa PENS Angkatan 2025',
                'bio'      => 'Saya suka web development dan IoT.',
            ]
        );
    }
}
