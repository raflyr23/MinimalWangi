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
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Relasi ke tabel orders
            $table->string('transaction_id');  // ID transaksi dari Midtrans
            $table->string('payment_type');  // Jenis pembayaran (credit_card, bank_transfer, dll)
            $table->string('payment_status');  // Status pembayaran (success, pending, failed)
            $table->string('bank')->nullable();  // Nama bank (untuk bank transfer)
            $table->timestamp('transaction_time');  // Waktu transaksi
            $table->decimal('gross_amount', 10, 2);  // Jumlah total yang dibayar
            $table->string('payment_url')->nullable();  // URL pembayaran (untuk bank transfer)
            $table->timestamps();  // Waktu pembuatan dan update
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
