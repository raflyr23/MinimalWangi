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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->nullable;
            $table->string('email')->nullable;
            $table->string('no_telp')->nullable;
            $table->string('alamat')->nullable;
            $table->string('nama_produk')->nullable;
            $table->string('jumlah')->nullable;
            $table->string('harga')->nullable;
            $table->string('image')->nullable;
            $table->string('user_id')->nullable;
            $table->string('product_id')->nullable;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
