<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class furniture extends Model
{
    use HasFactory;


      protected $guarded = ['id'];


    public function Image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function CartItemHistory()
    {
        return $this->hasMany(Cart_item_history::class, 'furniture_id');
    }
    public function CartItem()
    {
        return $this->hasMany(Cart_item::class, 'furniture_id');
    }
       public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
        public function primaryImage(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable')->where('is_primary', true);
    }
        public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
        public function cartItemHistories(): HasMany
    {
        return $this->hasMany(Cart_Item_History::class, 'furniture_id');
    }
        public function cartItems(): HasMany
    {
        return $this->hasMany(Cart_Item::class, 'furniture_id');
    }
}
