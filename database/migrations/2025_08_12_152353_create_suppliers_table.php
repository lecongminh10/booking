<?php

// 1. Create Suppliers Migration
// 2024_01_03_000001_create_suppliers_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id('supplier_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('restrict');
            $table->string('business_name', 255);
            $table->enum('business_type', ['INDIVIDUAL', 'COMPANY', 'PARTNERSHIP']);
            $table->string('tax_id', 50)->nullable();
            $table->string('business_license', 100)->nullable();
            $table->text('address');
            $table->string('city', 100);
            $table->string('district', 100)->nullable();
            $table->string('ward', 100)->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('website', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('logo_url', 500)->nullable();
            $table->string('cover_image_url', 500)->nullable();
            $table->enum('verification_status', ['PENDING', 'VERIFIED', 'REJECTED'])->default('PENDING');
            $table->enum('status', ['ACTIVE', 'INACTIVE', 'SUSPENDED'])->default('ACTIVE');
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('total_reviews')->default(0);
            $table->timestamps();
            
            $table->index(['user_id'], 'idx_suppliers_user_id');
            $table->index(['business_type'], 'idx_suppliers_business_type');
            $table->index(['verification_status'], 'idx_suppliers_verification_status');
            $table->index(['status'], 'idx_suppliers_status');
            $table->index(['city', 'district'], 'idx_suppliers_location');
        });
    }

    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
};