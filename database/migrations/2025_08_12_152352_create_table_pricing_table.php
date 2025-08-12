<?php

// ================================================================
// 5. Create Table Pricing Migration
// 2024_01_02_000005_create_table_pricing_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('table_pricing', function (Blueprint $table) {
            $table->id('pricing_id');
            $table->foreignId('table_id')->constrained('tables', 'table_id')->onDelete('cascade');
            $table->foreignId('slot_id')->constrained('time_slots', 'slot_id')->onDelete('cascade');
            $table->decimal('hourly_rate', 10, 2);
            $table->date('valid_from');
            $table->date('valid_to')->nullable();
            $table->timestamp('created_at')->useCurrent();
            
            $table->index(['valid_from', 'valid_to'], 'idx_pricing_validity');
            $table->index(['table_id', 'slot_id'], 'idx_table_pricing');
        });
    }

    public function down()
    {
        Schema::dropIfExists('table_pricing');
    }
};