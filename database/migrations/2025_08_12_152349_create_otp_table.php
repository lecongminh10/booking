<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('otp', function (Blueprint $table) {
            $table->id('otp_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->string('otp_code', 10);
            $table->enum('purpose', ['LOGIN', 'PASSWORD_RESET', 'TRANSACTION', 'PHONE_VERIFICATION']);
            $table->dateTime('expiry_datetime');
            $table->boolean('is_used')->default(false);
            $table->timestamp('created_at')->useCurrent();
            
            $table->index(['user_id', 'purpose'], 'idx_user_otp');
            $table->index(['expiry_datetime'], 'idx_expiry');
        });
    }

    public function down()
    {
        Schema::dropIfExists('otp');
    }
};
