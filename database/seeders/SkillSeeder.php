<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            'PHP',
            'JavaScript',
            'Python',
            'Java',
            'C#',
            'Ruby',
            'Go',
            'Swift',
            'Kotlin',
            'TypeScript',
            'HTML',
            'CSS',
            'SQL',
            'NoSQL',
            'Machine Learning',
            'Data Analysis',
        ];
        foreach ($skills as $skill) {
            Skill::create(['name' => $skill]);
        }
    }
}
