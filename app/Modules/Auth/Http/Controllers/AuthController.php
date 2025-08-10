<?php

namespace App\Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Http\Requests\LoginRequest;
use App\Modules\Auth\Http\Requests\RegisterRequest;
use App\Modules\Auth\Application\Services\AuthService;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService) {}

    public function login(LoginRequest $request)
    {
        return response()->json($this->authService->login($request->validated()));
    }

    public function register(RegisterRequest $request)
    {
        return response()->json($this->authService->register($request->validated()));
    }
}
