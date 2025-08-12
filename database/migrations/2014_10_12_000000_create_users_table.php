<?php
// 1. Create Users Migration
// 2024_01_01_000001_create_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('email', 255)->unique();
            $table->string('password_hash', 255);
            $table->string('phone', 20)->nullable();
            $table->enum('user_type', ['SUPER_ADMIN', 'CLUB_ADMIN', 'STORE_MANAGER', 'STAFF', 'CUSTOMER', 'SUPPLIER']);
            $table->enum('status', ['ACTIVE', 'INACTIVE', 'PENDING', 'LOCKED'])->default('PENDING');
            $table->dateTime('last_login')->nullable();
            $table->string('password_reset_token', 255)->nullable();
            $table->dateTime('password_reset_expiry')->nullable();
            $table->timestamps();
            
            $table->index(['email'], 'idx_email');
            $table->index(['user_type'], 'idx_user_type');
            $table->index(['status'], 'idx_status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};