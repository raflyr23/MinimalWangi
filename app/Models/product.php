<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    //
    public function reviews()
{
    return $this->hasMany(Review::class);
}
}
