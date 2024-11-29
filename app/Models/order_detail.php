<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/order_detail.php
class order_detail extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'nama_produk',
        'jumlah',
        'harga'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
