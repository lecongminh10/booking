<?php

// ================================================================
// 3. Create Supplier Services Migration
// 2024_01_03_000003_create_supplier_services_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('supplier_services', function (Blueprint $table) {
            $table->id('service_id');
            $table->foreignId('supplier_id')->constrained('suppliers', 'supplier_id')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories', 'category_id')->onDelete('restrict');
            $table->string('service_name', 255);
            $table->text('description')->nullable();
            $table->string('short_description', 500)->nullable();
            $table->json('features')->nullable();
            $table->json('inclusions')->nullable();
            $table->json('exclusions')->nullable();
            $table->integer('duration_minutes')->nullable();
            $table->integer('max_participants')->nullable();
            $table->integer('min_booking_hours')->default(24);
            $table->integer('cancellation_hours')->default(24);
            $table->enum('status', ['ACTIVE', 'INACTIVE', 'DRAFT'])->default('ACTIVE');
            $table->boolean('is_featured')->default(false);
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('total_reviews')->default(0);
            $table->integer('total_bookings')->default(0);
            $table->timestamps();
            
            $table->index(['supplier_id'], 'idx_supplier_services_supplier_id');
            $table->index(['category_id'], 'idx_supplier_services_category_id');
            $table->index(['status'], 'idx_supplier_services_status');
            $table->index(['is_featured'], 'idx_supplier_services_is_featured');
        });
    }

    public function down()
    {
        Schema::dropIfExists('supplier_services');
    }
};