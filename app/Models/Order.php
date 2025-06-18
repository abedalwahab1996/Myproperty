<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

         protected $guarded = ['id'];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'profile_id', 'id');
    }
    public function CartItemHistory()
    {
        return $this->hasMany(Cart_item_history::class, 'order_id');
    }
}
