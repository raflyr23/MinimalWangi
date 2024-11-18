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
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->string('name')->nullable();
                $table->string('email')->nullable();
                $table->string('no_hp')->nullable();
                $table->string('alamat')->nullable();
                $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // Relasi dengan tabel users
            
                // Data produk
                $table->string('nama_produk')->nullable();
                $table->integer('jumlah')->nullable(); // Ganti dengan integer untuk jumlah
                $table->decimal('harga', 15, 2)->nullable(); // Ganti dengan decimal untuk harga
                $table->string('image')->nullable();
                $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('set null'); // Relasi dengan tabel products
            
                // Status
                $table->string('payment_status')->nullable();
                $table->string('delivery_status')->nullable();
                
                $table->timestamps();
            });
            
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
