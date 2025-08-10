<?php

namespace App\Modules\Auth\Application\Services;

use App\Modules\Auth\Domain\Repositories\UserRepositoryInterface;

class AuthService
{
    public function __construct(protected UserRepositoryInterface $users) {}

    public function login(array $credentials)
    {
        // TODO: implement login logic
        return ['message' => 'Login successful'];
    }

    public function register(array $data)
    {
        // TODO: implement register logic
        return ['message' => 'Register successful'];
    }
}
