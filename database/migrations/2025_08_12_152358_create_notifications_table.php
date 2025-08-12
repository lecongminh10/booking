<?php

// 1. Create Notifications Migration
// 2024_01_06_000001_create_notifications_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('notification_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers', 'supplier_id')->onDelete('set null');
            $table->foreignId('booking_id')->nullable()->constrained('bookings', 'booking_id')->onDelete('set null');
            $table->string('title', 255);
            $table->text('content');
            $table->enum('notification_type', ['BOOKING', 'PAYMENT', 'PROMOTION', 'SYSTEM']);
            $table->enum('delivery_method', ['PUSH', 'SMS', 'EMAIL'])->default('PUSH');
            $table->boolean('is_read')->default(false);
            $table->dateTime('sent_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
            
            $table->index(['user_id', 'is_read'], 'idx_user_notifications');
            $table->index(['notification_type'], 'idx_notification_type');
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};