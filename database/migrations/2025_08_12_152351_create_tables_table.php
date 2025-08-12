<?php

// ================================================================
// 3. Create Tables Migration
// 2024_01_02_000003_create_tables_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->id('table_id');
            $table->foreignId('store_id')->constrained('stores', 'store_id')->onDelete('cascade');
            $table->string('table_number', 10);
            $table->enum('table_type', ['POOL', 'SNOOKER', 'CAROM']);
            $table->decimal('hourly_rate', 10, 2);
            $table->enum('status', ['AVAILABLE', 'OCCUPIED', 'MAINTENANCE', 'RESERVED'])->default('AVAILABLE');
            $table->timestamps();
            
            $table->unique(['store_id', 'table_number'], 'uk_store_table');
            $table->index(['status'], 'idx_table_status');
            $table->index(['table_type'], 'idx_table_type');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tables');
    }
};