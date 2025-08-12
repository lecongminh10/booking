<?php

// ================================================================
// 4. Create Time Slots Migration
// 2024_01_02_000004_create_time_slots_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('time_slots', function (Blueprint $table) {
            $table->id('slot_id');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('slot_type', ['PEAK', 'NORMAL']);
            $table->decimal('price_multiplier', 3, 2)->default(1.00);
            $table->boolean('is_active')->default(true);
            
            $table->index(['start_time', 'end_time'], 'idx_time_range');
            $table->index(['slot_type'], 'idx_slot_type');
        });
    }

    public function down()
    {
        Schema::dropIfExists('time_slots');
    }
};
