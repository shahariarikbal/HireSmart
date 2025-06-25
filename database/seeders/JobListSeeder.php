<?php

namespace Database\Seeders;

use App\Models\JobList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobList::factory()->count(10)->create();
    }
}
