<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payment_gateways', function (Blueprint $table) {
            $table->bigIncrements('gateway_id');
            $table->string('name', 100); // Ví dụ: MoMo, VNPAY, PayPal
            $table->string('code', 50)->unique(); // momo, vnpay, paypal
            $table->json('config')->nullable(); // Lưu API key, secret, endpoint
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_gateways');
    }
};
