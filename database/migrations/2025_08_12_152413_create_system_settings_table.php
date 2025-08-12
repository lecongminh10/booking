<?php

// ================================================================
// 2. Create System Settings Migration
// 2024_01_07_000002_create_system_settings_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id('setting_id');
            $table->string('setting_key', 100)->unique();
            $table->text('setting_value');
            $table->text('description')->nullable();
            $table->timestamp('updated_at')->useCurrent();
            
            $table->index(['setting_key'], 'idx_setting_key');
        });
    }

    public function down()
    {
        Schema::dropIfExists('system_settings');
    }
};