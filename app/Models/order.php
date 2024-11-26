<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'no_hp',
        'alamat',
        'total_amount',
        'payment_status',
        'delivery_status',
    ];

    public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}

}
