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
        Schema::table('orders', function (Blueprint $table) {
            // Menghapus kolom yang tidak dibutuhkan
            $table->dropColumn(['nama_produk', 'jumlah', 'harga', 'image', 'product_id']);
            
            // Menambahkan kolom total order
            $table->decimal('total_amount', 15, 2)->nullable(); // Total biaya order
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Mengembalikan perubahan jika rollback
            $table->string('nama_produk')->nullable();
            $table->integer('jumlah')->nullable();
            $table->decimal('harga', 15, 2)->nullable();
            $table->string('image')->nullable();
            $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('set null');
        });
    }
};
