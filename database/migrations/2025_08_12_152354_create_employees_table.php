<?php


// ================================================================
// 4. Create Employees Migration
// 2024_01_03_000004_create_employees_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id('employee_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('restrict');
            $table->foreignId('supplier_id')->constrained('suppliers', 'supplier_id')->onDelete('cascade');
            $table->timestamps();
            
            $table->index(['supplier_id'], 'idx_employees_supplier_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
