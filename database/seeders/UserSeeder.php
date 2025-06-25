<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@hiresmart.com',
                'role' => 'admin',
            ],
            [
                'name' => 'Employer one',
                'email' => 'employer.one@hiresmart.com',
                'role' => 'employer',
            ],
            [
                'name' => 'Employer two',
                'email' => 'employer.two@hiresmart.com',
                'role' => 'employer',
            ],
            [
                'name' => 'Employer three',
                'email' => 'employer.three@hiresmart.com',
                'role' => 'employer',
            ],
            [
                'name' => 'Candidate one',
                'email' => 'candidate.one@hiresmart.com',
                'role' => 'candidate',
            ],
            [
                'name' => 'Candidate two',
                'email' => 'candidate.two@hiresmart.com',
                'role' => 'candidate',
            ],
            [
                'name' => 'Candidate three',
                'email' => 'candidate.three@hiresmart.com',
                'role' => 'candidate',
            ],
            [
                'name' => 'Candidate four',
                'email' => 'candidate.four@hiresmart.com',
                'role' => 'candidate',
            ],

        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role'],
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'remember_token' => null,
            ]);
        }
    }
}
