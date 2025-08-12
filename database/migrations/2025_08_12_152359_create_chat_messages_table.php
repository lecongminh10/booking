<?php

// ================================================================
// 3. Create Chat Messages Migration
// 2024_01_06_000003_create_chat_messages_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id('message_id');
            $table->foreignId('conversation_id')->constrained('chat_conversations', 'conversation_id')->onDelete('cascade');
            $table->foreignId('sender_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->text('message_content');
            $table->enum('message_type', ['TEXT', 'IMAGE', 'SYSTEM'])->default('TEXT');
            $table->boolean('is_read')->default(false);
            $table->timestamp('sent_at')->useCurrent();
            
            $table->index(['conversation_id', 'sent_at'], 'idx_conversation_messages');
        });
    }

    public function down()
    {
        Schema::dropIfExists('chat_messages');
    }
};
