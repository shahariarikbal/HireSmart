<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = $this->authService->attemptLogin($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'token' => $token,
            'user' => $this->authService->getUser()
        ]);
    }

    public function profileUpdate(Request $request)
    {
        $user_profile_update = $this->authService->userProfileUpdate($request);
        return response()->json([
            'status' => 201,
            'data' => $user_profile_update,
            'message' => 'User profile has been updated'
        ]);
    }

    public function logout()
    {
        $this->authService->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
