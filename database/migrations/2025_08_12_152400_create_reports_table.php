<?php

// 1. Create Reports Migration
// 2024_01_07_000001_create_reports_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id('report_id');
            $table->foreignId('store_id')->nullable()->constrained('stores', 'store_id')->onDelete('cascade');
            $table->foreignId('organization_id')->nullable()->constrained('organizations', 'organization_id')->onDelete('cascade');
            $table->enum('report_type', ['DAILY_REVENUE', 'WEEKLY_REVENUE', 'MONTHLY_REVENUE', 'UTILIZATION', 'BOOKING_ANALYSIS']);
            $table->date('report_date');
            $table->json('report_data');
            $table->timestamp('generated_at')->useCurrent();
            
            $table->index(['report_date', 'report_type'], 'idx_report_date');
            $table->index(['store_id'], 'idx_store_reports');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
};
