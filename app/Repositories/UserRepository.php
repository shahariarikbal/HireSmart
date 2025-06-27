<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserProfile;
use App\Services\ImageService;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function getUserProfile()
    {
        $user = auth()->user();
        return $user;
    }

    public function profileUpdate($data)
    {
        $user = auth()->user();

        DB::beginTransaction();
        try {
                $image = $this->imageService->updateImage(
                    $data['image'] ?? null,
                    'images/avatar',
                    $user->avatar
                );

                if ($user) {
                    $user->update([
                        'name' => trim($data['name']),
                        'email' => trim($data['email']),
                        'avatar' => $image
                    ]);

                    // update profiles table data insert
                    UserProfile::updateOrCreate([
                        'user_id' => $user->id
                    ], [
                        'preferred_location' => $data['preferred_location'],
                        'expected_salary_min' => $data['expected_salary_min'],
                        'expected_salary_max' => $data['expected_salary_max'],
                    ]);
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
        }
    }
}