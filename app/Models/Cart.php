<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;


         protected $guarded = ['id'];
    protected $with = ['items'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function CartItemHistory()
    {
        return $this->hasMany(Cart_item_history::class, 'cart_id');
    }
    public function CartItem()
    {
        return $this->hasMany(Cart_item::class, 'cart_id');
    }
    public function items()
    {
        return $this->belongsToMany(furniture::class, 'cart_items')->withPivot([
            'quantity',
            'price',
            'id'
        ]);
    }
    public function getTotal()
    {
        return number_format($this->items->sum(fn($item) => $item->pivot->quantity * $item->price), 2);
    }
}
