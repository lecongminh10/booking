<?php

// ================================================================
// 6. Create Services Migration
// 2024_01_02_000006_create_services_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id('service_id');
            $table->foreignId('store_id')->constrained('stores', 'store_id')->onDelete('cascade');
            $table->string('service_name', 255);
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->enum('service_type', ['FOOD', 'DRINK', 'EQUIPMENT', 'OTHER']);
            $table->string('image_url', 500)->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
            
            $table->index(['store_id', 'is_available'], 'idx_store_services');
            $table->index(['service_type'], 'idx_service_type');
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
};