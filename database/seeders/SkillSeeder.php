<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            ['name' => 'PHP',           'category' => 'Programming'],
            ['name' => 'Laravel',       'category' => 'Framework'],
            ['name' => 'JavaScript',    'category' => 'Programming'],
            ['name' => 'Public Speaking','category' => 'Soft Skill'],
            ['name' => 'UI/UX',         'category' => 'Design'],
        ];

        foreach ($skills as $skill) {
            Skill::firstOrCreate(
                ['name' => $skill['name']],
                ['category' => $skill['category']]
            );
        }
    }
}
