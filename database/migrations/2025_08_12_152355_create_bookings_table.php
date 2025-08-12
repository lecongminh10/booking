<?php

// 1. Create Bookings Migration
// 2024_01_04_000001_create_bookings_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('booking_id');
            $table->string('booking_code', 20)->unique();
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('restrict');
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers', 'supplier_id')->onDelete('restrict');
            $table->foreignId('store_id')->nullable()->constrained('stores', 'store_id')->onDelete('cascade');
            $table->foreignId('table_id')->nullable()->constrained('tables', 'table_id')->onDelete('cascade');
            $table->foreignId('service_id')->nullable()->constrained('supplier_services', 'service_id')->onDelete('restrict');
            $table->date('booking_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('participants')->default(1);
            $table->decimal('total_amount', 12, 2);
            $table->enum('booking_status', ['PENDING', 'CONFIRMED', 'IN_PROGRESS', 'COMPLETED', 'CANCELLED'])->default('PENDING');
            $table->enum('payment_status', ['PENDING', 'PARTIAL', 'PAID', 'REFUNDED'])->default('PENDING');
            $table->string('qr_code', 500)->nullable();
            $table->text('notes')->nullable();
            $table->text('special_requests')->nullable();
            $table->timestamps();
            
            $table->index(['booking_date', 'start_time'], 'idx_booking_date');
            $table->index(['booking_status'], 'idx_booking_status');
            $table->index(['user_id'], 'idx_customer_bookings');
            $table->index(['store_id'], 'idx_store_bookings');
            $table->index(['table_id', 'booking_date'], 'idx_table_bookings');
            $table->index(['supplier_id'], 'idx_supplier_bookings');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
