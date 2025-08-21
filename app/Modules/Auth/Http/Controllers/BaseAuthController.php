<?php

namespace App\Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Http\Requests\LoginRequest;
use App\Modules\Auth\Application\Services\AuthService;
use App\Modules\Auth\Http\Requests\RegisterRequest;

abstract class BaseAuthController extends Controller
{
    public function __construct(
        protected AuthService $authService,
        protected string $requiredRole // super_admin, club_admin, store_manager
    ) {}

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $data['required_role'] = $this->requiredRole;

        return response()->json(
            $this->authService->loginWithRole($data)
        );
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Logged out successfully']);
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['user_type'] = $this->requiredRole; // tự động gán user_type

        return response()->json(
            $this->authService->register($data)
        );
    }
}
