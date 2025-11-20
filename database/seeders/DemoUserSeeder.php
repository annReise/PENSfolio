<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat 1 user demo
        $user = User::firstOrCreate(
            ['email' => 'demo@example.com'],
            [
                'name' => 'Demo User',
                'password' => Hash::make('password'), // password: password
            ]
        );

        // Buat profile untuk user demo
        $user->profile()->firstOrCreate(
            [],
            [
                'username' => 'demouser',
                'headline' => 'Mahasiswa PENS Angkatan 2025',
                'bio' => 'Saya tertarik pada web development dan Internet of Things.',
                'website' => 'https://example.com',
                'github' => 'https://github.com/example',
            ]
        );
    }
}
