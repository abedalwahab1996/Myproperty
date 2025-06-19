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
        'role'
    ];
    // public function hasRole($role)
    // {
    //     return $this->role === $role;
    // }
        
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    // Removed the is_admin cast

    public function cart()
    {
        return $this->hasOne(Cart::class, 'user_id');
    }

    public function orders() // Changed to lowercase and plural
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id');
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function furnitures()
    {
        return $this->hasMany(Furniture::class);
    }

    // Removed the role() relationship (Laratrust handles this)
    // Removed isAdmin() - use $user->hasRole('admin') instead
}