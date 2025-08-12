<?php

// ================================================================
// 4. Create Transactions Migration
// 2024_01_04_000004_create_transactions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->string('transaction_code', 50)->unique();
            $table->foreignId('from_wallet_id')->nullable()->constrained('wallets', 'wallet_id')->onDelete('set null');
            $table->foreignId('to_wallet_id')->nullable()->constrained('wallets', 'wallet_id')->onDelete('set null');
            $table->foreignId('booking_id')->nullable()->constrained('bookings', 'booking_id')->onDelete('set null');
            $table->decimal('amount', 15, 2);
            $table->decimal('fee_amount', 10, 2)->default(0.00);
            $table->enum('transaction_type', ['DEPOSIT', 'WITHDRAWAL', 'PAYMENT', 'REFUND', 'TRANSFER']);
            $table->enum('status', ['PENDING', 'APPROVED', 'COMPLETED', 'REJECTED', 'FAILED'])->default('PENDING');
            $table->enum('payment_method', ['CASH', 'VNPAY', 'MOMO', 'BANKING', 'WALLET']);
            $table->text('description')->nullable();
            $table->string('reference_code', 255)->nullable();
            $table->timestamps();
            
            $table->index(['status'], 'idx_transaction_status');
            $table->index(['transaction_type'], 'idx_transaction_type');
            $table->index(['booking_id'], 'idx_booking_transactions');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
