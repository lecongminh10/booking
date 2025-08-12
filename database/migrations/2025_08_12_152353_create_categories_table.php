<?php

// ================================================================
// 2. Create Categories Migration
// 2024_01_03_000002_create_categories_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id('category_id');
            $table->foreignId('parent_id')->nullable()->constrained('categories', 'category_id')->onDelete('set null');
            $table->string('category_name', 255);
            $table->text('description')->nullable();
            $table->string('icon_url', 500)->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            $table->index(['parent_id'], 'idx_categories_parent_id');
            $table->index(['is_active'], 'idx_categories_is_active');
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
};