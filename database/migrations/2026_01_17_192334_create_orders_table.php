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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        $table->string('order_code')->unique(); // contoh: ORD-20260117-XXXX
        $table->integer('total_price');

        $table->string('payment_method'); // bca, mandiri, dana, qris, dll
        $table->string('status')->default('pending'); // pending, paid, cancelled

        $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
