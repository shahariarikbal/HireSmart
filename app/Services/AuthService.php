<?php

namespace App\Services;

use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    public function attemptLogin($credentials)
    {
        return JWTAuth::attempt($credentials);
    }

    public function getUser()
    {
        return JWTAuth::user();
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return true;
    }
}
