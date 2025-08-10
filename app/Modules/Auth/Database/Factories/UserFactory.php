<?php

namespace App\Modules\Auth\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Modules\Auth\Infra\Eloquent\UserModel;

class UserFactory extends Factory
{
    protected $model = UserModel::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('12345678'), // mật khẩu cố định
        ];
    }
}
