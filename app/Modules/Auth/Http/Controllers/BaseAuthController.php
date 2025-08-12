<?php

namespace App\Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Http\Requests\LoginRequest;
use App\Modules\Auth\Application\Services\AuthService;

abstract class BaseAuthController extends Controller
{
    public function __construct(
        protected AuthService $authService,
        protected string $requiredRole // SUPER_ADMIN, CLUB_ADMIN, STORE_MANAGER
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
}
