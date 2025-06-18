<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart_item extends Model
{
    use HasFactory;

      protected $guarded = ['id'];

    public function Furniture()
    {
        return $this->belongsTo(Furniture::class, 'furniture_id');
    }
    public function Cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }
}
