<?php

namespace App\Modules\Auth\Domain\Repositories;

use App\Modules\Auth\Domain\Entities\UserEntity;

interface UserRepositoryInterface
{
    public function create(UserEntity $user): UserEntity;
    public function all(): array;
}
