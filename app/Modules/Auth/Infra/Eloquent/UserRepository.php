<?php

namespace App\Modules\Auth\Infra\Eloquent;

use App\Modules\Auth\Domain\Entities\UserEntity;
use App\Modules\Auth\Domain\Repositories\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function create(UserEntity $user): UserEntity
    {
        $model = UserModel::create([
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
        ]);

        return new UserEntity($model->id, $model->name, $model->email, $model->password);
    }

    public function all(): array
    {
        return UserModel::all()->map(fn($model) =>
            new UserEntity($model->id, $model->name, $model->email, $model->password)
        )->toArray();
    }
}
