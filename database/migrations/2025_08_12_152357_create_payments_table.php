<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Tạo ENUM
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('payment_id');
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->decimal('amount', 12, 2);
            
            // Enum Laravel 10 cho MySQL
            $table->enum('payment_method', ['CASH', 'BANK_TRANSFER', 'CREDIT_CARD', 'MOMO', 'VNPAY', 'PAYPAL']);
            $table->enum('payment_status', ['PENDING', 'SUCCESS', 'FAILED'])->default('PENDING');
            
            $table->string('payment_reference', 255)->nullable();
            $table->json('gateway_response')->nullable();
            $table->dateTime('payment_date')->useCurrent();
            $table->dateTime('created_at')->useCurrent();
            
            // Indexes
            $table->index('booking_id', 'idx_booking_payments');
            $table->index('payment_status', 'idx_payment_status');
            $table->index('user_id', 'idx_payments_user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
