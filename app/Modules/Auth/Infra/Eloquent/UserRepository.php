<?php

namespace App\Modules\Auth\Infra\Eloquent;

use App\Modules\Auth\Domain\Entities\UserEntity;
use App\Modules\Auth\Domain\Repositories\UserRepositoryInterface;
use App\Modules\Auth\Domain\Repositories\BaseRepository;
use Carbon\Carbon;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(UserModel $model)
    {
        parent::__construct($model);
    }

    /**
     * Tạo mới user
     */
    public function create(UserEntity $user): UserEntity
    {
        $model = $this->model->create([
            'email'                 => $user->email,
            'password_hash'         => $user->password_hash,
            'phone'                 => $user->phone,
            'user_type'              => $user->user_type,
            'status'                 => $user->status,
            'last_login'             => $user->last_login,
            'password_reset_token'   => $user->password_reset_token,
            'password_reset_expiry'  => $user->password_reset_expiry,
        ]);

        return $this->toEntity($model);
    }

    /**
     * Lấy tất cả user
     */
    public function all(): array
    {
        return $this->model->all()
            ->map(fn(UserModel $model) => $this->toEntity($model))
            ->toArray();
    }

    /**
     * Mapping từ Eloquent model sang Domain entity
     */
    private function toEntity(UserModel $model): UserEntity
    {
        return new UserEntity(
            user_id:               $model->user_id,
            email:                 $model->email,
            password_hash:         $model->password_hash,
            phone:                 $model->phone,
            user_type:             $model->user_type,
            status:                $model->status,
            last_login:            $model->last_login ? Carbon::parse($model->last_login) : null,
            password_reset_token:  $model->password_reset_token,
            password_reset_expiry: $model->password_reset_expiry ? Carbon::parse($model->password_reset_expiry) : null,
            created_at:            Carbon::parse($model->created_at),
            updated_at:            Carbon::parse($model->updated_at)
        );
    }
}
