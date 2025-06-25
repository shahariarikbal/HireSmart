<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobList>
 */
class JobListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle(),
            'description' => fake()->paragraphs(3, true),
            'location' => fake()->city(),
            'job_type' => fake()->randomElement(['full_time', 'remote', 'part_time', 'contract', 'temporary', 'internship']),
            'experience_level' => fake()->randomElement(['entry_level', 'mid_level', 'senior_level', 'executive']),
            'salary_min' => fake()->numberBetween(30000, 100000),
            'salary_max' => fake()->numberBetween(100000, 200000),
            'is_active' => fake()->boolean(80), // 80% chance of being true
            'user_id' => User::where('role', 'employer')->inRandomOrder()->value('id'),
            'avatar' => fake()->imageUrl(640, 480, 'business', true, 'Job Listing', false) // Generates a placeholder image URL
        ];
    }
}
