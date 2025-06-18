<?php

namespace App\Models;

use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements LaratrustUser
{
    use HasRolesAndPermissions;

protected $fillable = [
    'name',
    'email',
    'password',
    'is_admin'
];
protected $casts = [
    'is_admin' => 'boolean',
];
     public function Cart()
    {
        return $this->hasOne(Cart::class, 'user_id');
    }
    public function Order()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function Profile()
    {
        return $this->hasOne(Profile::class, 'user_id');
    }

    // app/Models/User.php
public function properties()
{
    return $this->hasMany(Property::class);
}

public function role()
{
    return $this->belongsToMany(Role::class);
}

public function isAdmin()
{
    return $this->roles()->where('name', 'admin')->exists();
}

}
