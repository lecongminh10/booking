<?php

// ================================================================
// 2. Create Sessions Migration
// 2024_01_04_000002_create_sessions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->id('session_id');
            $table->foreignId('booking_id')->constrained('bookings', 'booking_id')->onDelete('cascade');
            $table->foreignId('staff_id')->nullable()->constrained('users', 'user_id')->onDelete('set null');
            $table->dateTime('actual_start_time')->nullable();
            $table->dateTime('actual_end_time')->nullable();
            $table->decimal('actual_duration', 5, 2)->nullable();
            $table->decimal('final_amount', 12, 2)->nullable();
            $table->enum('session_status', ['NOT_STARTED', 'IN_PROGRESS', 'COMPLETED'])->default('NOT_STARTED');
            $table->timestamps();
            
            $table->index(['session_status'], 'idx_session_status');
            $table->index(['staff_id'], 'idx_staff_sessions');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sessions');
    }
};