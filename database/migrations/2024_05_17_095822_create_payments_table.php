<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("order_id")
                ->constrained('orders')
                ->onDelete('cascade');
            $table->string("payment_method", 64);
            $table->string("transaction_id", 256)->unique();
            $table->decimal("amount", 10, 2);
            $table->string("currency", 3);
            $table->string("status", 128);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
