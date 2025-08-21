<?php

namespace App\Modules\Auth\Application\Services;

use App\Modules\Auth\Infra\Eloquent\UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Modules\Auth\Domain\Entities\UserEntity;
use App\Modules\Auth\Infra\Eloquent\UserRepository;
use Carbon\Carbon;
class AuthService
{

    public function __construct(protected UserRepository $userRepo) {}
    public function loginWithRole(array $credentials)
    {   
        $user = UserModel::where('email', $credentials['email'])
            ->where('user_type', operator: $credentials['required_role'])
            ->first();

        if (!$user || !Hash::check($credentials['password'], $user->password_hash)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect or role not allowed.'],
            ]);
        }

       $token = $user->createToken(name: 'auth_token')->plainTextToken;

        return [
            'user'  => $user,
            'token' => $token,
            'role'  => $user->user_type
        ];
    }
    public function register(array $data)
    {
        $userEntity = new UserEntity(
            user_id: null,
            email: $data['email'],
            password_hash: Hash::make($data['password']),
            phone: $data['phone'] ?? null,
            user_type: $data['user_type'],
            status: UserModel::STATUS_ACTIVE,
            last_login: null,
            password_reset_token: null,
            password_reset_expiry: null,
            created_at: Carbon::now(),
            updated_at: Carbon::now()
        );

        $user = $this->userRepo->create($userEntity);

        $token = $this->userRepo
            ->findModelById($user->user_id)
            ->createToken('auth_token')->plainTextToken;

        return [
            'message' => 'Đăng ký thành công',
            'user'    => $user,
            'token'   => $token
        ];
    }
}
