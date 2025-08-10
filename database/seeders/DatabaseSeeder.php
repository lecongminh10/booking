<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Modules\Auth\Domain\Entities\UserEntity;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         UserEntity::factory()->count(20)->create([
            'password' => Hash::make('12345678')
        ]);
    }
}
