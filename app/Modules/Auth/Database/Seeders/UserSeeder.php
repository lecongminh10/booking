<?php

namespace App\Modules\Auth\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Auth\Infra\Eloquent\UserModel;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        UserModel::factory()->count(20)->create();
    }
}
