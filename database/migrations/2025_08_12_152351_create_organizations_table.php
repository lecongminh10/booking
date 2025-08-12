<?php

// 1. Create Organizations Migration
// 2024_01_02_000001_create_organizations_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id('organization_id');
            $table->string('organization_name', 255);
            $table->text('description')->nullable();
            $table->text('address')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('tax_code', 50)->nullable();
            $table->string('logo_url', 500)->nullable();
            $table->enum('status', ['ACTIVE', 'INACTIVE'])->default('ACTIVE');
            $table->timestamps();
            
            $table->index(['status'], 'idx_organization_status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('organizations');
    }
};