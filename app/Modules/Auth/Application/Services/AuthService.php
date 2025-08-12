<?php

namespace App\Modules\Auth\Application\Services;

use App\Modules\Auth\Infra\Eloquent\UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function loginWithRole(array $credentials)
    {
        $user = UserModel::where('email', $credentials['email'])
            ->where('user_type', $credentials['required_role'])
            ->first();

        if (!$user || !Hash::check($credentials['password'], $user->password_hash)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect or role not allowed.'],
            ]);
        }

       $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user'  => $user,
            'token' => $token,
            'role'  => $user->user_type
        ];
    }
}
