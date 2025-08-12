<?php

// ================================================================
// 2. Create Chat Conversations Migration
// 2024_01_06_000002_create_chat_conversations_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('chat_conversations', function (Blueprint $table) {
            $table->id('conversation_id');
            $table->foreignId('customer_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('store_id')->constrained('stores', 'store_id')->onDelete('cascade');
            $table->enum('status', ['ACTIVE', 'CLOSED'])->default('ACTIVE');
            $table->dateTime('last_message_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            
            $table->index(['customer_id'], 'idx_customer_conversations');
            $table->index(['store_id'], 'idx_store_conversations');
        });
    }

    public function down()
    {
        Schema::dropIfExists('chat_conversations');
    }
};

