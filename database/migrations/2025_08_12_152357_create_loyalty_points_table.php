<?php

// 1. Create Loyalty Points Migration
// 2024_01_05_000001_create_loyalty_points_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('loyalty_points', function (Blueprint $table) {
            $table->id('point_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('booking_id')->nullable()->constrained('bookings', 'booking_id')->onDelete('set null');
            $table->integer('points_earned')->default(0);
            $table->integer('points_used')->default(0);
            $table->integer('points');
            $table->enum('transaction_type', ['EARNED', 'USED', 'EXPIRED']);
            $table->enum('source', ['BOOKING', 'REFERRAL', 'PROMOTION', 'BONUS']);
            $table->text('description')->nullable();
            $table->date('expiry_date')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            
            $table->index(['user_id'], 'idx_customer_points');
            $table->index(['expiry_date'], 'idx_points_expiry');
        });
    }

    public function down()
    {
        Schema::dropIfExists('loyalty_points');
    }
};
