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
        Schema::create('keranjang_pembelians', function (Blueprint $table) {
            $table->id('id_keranjang');
            $table->integer('id_user');
            $table->integer('id_produk');
            $table->integer('jumlah');
            $table->double('harga');
            $table->double('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjang_pembelians');
    }
};
