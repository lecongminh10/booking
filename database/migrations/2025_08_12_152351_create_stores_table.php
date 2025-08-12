<?php

// ================================================================
// 2. Create Stores Migration
// 2024_01_02_000002_create_stores_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id('store_id');
            $table->foreignId('organization_id')->constrained('organizations', 'organization_id')->onDelete('cascade');
            $table->foreignId('store_manager_id')->nullable()->constrained('users', 'user_id')->onDelete('set null');
            $table->string('store_name', 255);
            $table->text('address');
            $table->string('phone', 20)->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->json('opening_hours')->nullable();
            $table->json('store_images')->nullable();
            $table->enum('status', ['ACTIVE', 'INACTIVE', 'MAINTENANCE'])->default('ACTIVE');
            $table->timestamps();
            
            $table->index(['latitude', 'longitude'], 'idx_store_location');
            $table->index(['status'], 'idx_store_status');
            $table->index(['organization_id'], 'idx_organization');
        });
    }

    public function down()
    {
        Schema::dropIfExists('stores');
    }
};

