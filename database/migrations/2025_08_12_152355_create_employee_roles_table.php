<?php

// ================================================================
// 5. Create Employee Roles Migration
// 2024_01_03_000005_create_employee_roles_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('employee_roles', function (Blueprint $table) {
            $table->id('role_id');
            $table->foreignId('employee_id')->constrained('employees', 'employee_id')->onDelete('cascade');
            $table->enum('role', ['MANAGER', 'STAFF', 'ADMIN']);
            $table->timestamp('assigned_at')->useCurrent();
            
            $table->index(['employee_id'], 'idx_employee_roles_employee_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('employee_roles');
    }
};
