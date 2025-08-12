<?php

// ================================================================
// 5. Create Wallets Migration
// 2024_01_01_000005_create_wallets_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id('wallet_id');
            $table->foreignId('user_id')->nullable()->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('organization_id')->nullable()->constrained('organizations', 'organization_id')->onDelete('cascade');
            $table->enum('wallet_type', ['CENTRAL', 'CLUB', 'STORE', 'CUSTOMER']);
            $table->decimal('balance', 15, 2)->default(0.00);
            $table->enum('status', ['ACTIVE', 'INACTIVE', 'SUSPENDED'])->default('ACTIVE');
            $table->dateTime('last_updated')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
            
            $table->index(['wallet_type'], 'idx_wallet_type');
            $table->index(['status'], 'idx_wallet_status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('wallets');
    }
};