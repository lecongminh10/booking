<?php

// ================================================================
// 3. Create Session Services Migration
// 2024_01_04_000003_create_session_services_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('session_services', function (Blueprint $table) {
            $table->id('session_service_id');
            $table->foreignId('session_id')->constrained('sessions', 'session_id')->onDelete('cascade');
            $table->foreignId('service_id')->constrained('services', 'service_id')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->decimal('unit_price', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->timestamp('added_at')->useCurrent();
            
            $table->index(['session_id'], 'idx_session_services');
        });
    }

    public function down()
    {
        Schema::dropIfExists('session_services');
    }
};