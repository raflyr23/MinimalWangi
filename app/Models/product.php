<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{

    protected $fillable = [
        'nama_produk',
        'diskon',
        'harga',
        'jumlah',
        'image'
        // ... other fields
    ];
    //
    public function reviews()
{
    return $this->hasMany(Review::class);
}
}
