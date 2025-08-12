<?php

// ================================================================
// 4. Create Messages Migration
// 2024_01_06_000004_create_messages_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id('message_id');
            $table->foreignId('sender_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('receiver_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->string('subject', 255)->nullable();
            $table->text('content');
            $table->enum('message_type', ['PERSONAL', 'BUSINESS', 'SYSTEM'])->default('PERSONAL');
            $table->boolean('is_read')->default(false);
            $table->foreignId('parent_message_id')->nullable()->constrained('messages', 'message_id')->onDelete('set null');
            $table->timestamp('sent_at')->useCurrent();
            
            $table->index(['sender_id'], 'idx_messages_sender_id');
            $table->index(['receiver_id'], 'idx_messages_receiver_id');
            $table->index(['sent_at'], 'idx_messages_sent_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
};
