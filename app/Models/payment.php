<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class payment extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'user_id', 'gross_amount', 'payment_status'];

}
