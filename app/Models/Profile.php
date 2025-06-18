<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    use HasFactory;

          protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }

    public function Image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
