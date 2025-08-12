<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        DB::table('users')->insert([
            [
                'email' => 'superadmin@example.com',
                'password_hash' => Hash::make('password'),
                'phone' => '0123456789',
                'user_type' => 'SUPER_ADMIN',
                'status' => 'ACTIVE',
                'last_login' => null,
                'password_reset_token' => null,
                'password_reset_expiry' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'email' => 'clubadmin@example.com',
                'password_hash' => Hash::make('password'),
                'phone' => '0987654321',
                'user_type' => 'CLUB_ADMIN',
                'status' => 'ACTIVE',
                'last_login' => null,
                'password_reset_token' => null,
                'password_reset_expiry' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'email' => 'storemanager@example.com',
                'password_hash' => Hash::make('password'),
                'phone' => '0911222333',
                'user_type' => 'STORE_MANAGER',
                'status' => 'ACTIVE',
                'last_login' => null,
                'password_reset_token' => null,
                'password_reset_expiry' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}