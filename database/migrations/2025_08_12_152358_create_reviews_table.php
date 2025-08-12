<?php

// ================================================================
// 2. Create Reviews Migration
// 2024_01_05_000002_create_reviews_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('review_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('restrict');
            $table->foreignId('supplier_id')->constrained('suppliers', 'supplier_id')->onDelete('cascade');
            $table->foreignId('service_id')->constrained('supplier_services', 'service_id')->onDelete('cascade');
            $table->foreignId('store_id')->nullable()->constrained('stores', 'store_id')->onDelete('cascade');
            $table->foreignId('booking_id')->nullable()->constrained('bookings', 'booking_id')->onDelete('set null');
            $table->integer('rating')->comment('1-5 stars');
            $table->string('title', 255)->nullable();
            $table->text('comment')->nullable();
            $table->json('review_images')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_anonymous')->default(false);
            $table->integer('helpful_count')->default(0);
            $table->timestamps();
            
            $table->index(['store_id', 'rating'], 'idx_store_reviews');
            $table->index(['user_id'], 'idx_customer_reviews');
            $table->index(['supplier_id'], 'idx_reviews_supplier_id');
            $table->index(['service_id'], 'idx_reviews_service_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};
