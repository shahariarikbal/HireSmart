<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function attemptLogin($credentials)
    {
        return JWTAuth::attempt($credentials);
    }

    public function getUser()
    {
        return JWTAuth::user();
    }

    public function userProfileUpdate($data)
    {
        return $this->userRepository->profileUpdate($data);
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return true;
    }
}
