<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            ['name' => 'PHP',            'category' => 'Programming'],
            ['name' => 'Laravel',        'category' => 'Framework'],
            ['name' => 'JavaScript',     'category' => 'Programming'],
            ['name' => 'Public Speaking','category' => 'Soft Skill'],
            ['name' => 'UI/UX',          'category' => 'Design'],
        ];

        foreach ($skills as $data) {
            Skill::firstOrCreate(['name' => $data['name']], $data);
        }
    }
}
