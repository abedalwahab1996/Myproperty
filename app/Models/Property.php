<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'address',
        'price',
        'area',
        'number',
        'is_publish',
        'user_id' // Added user_id to fillable for mass assignment
    ];

    protected $casts = [
        'is_publish' => 'boolean', // Ensures is_publish is cast to boolean
        'price' => 'decimal:2', // Ensures price is stored with 2 decimal places
        'area' => 'decimal:2' // Ensures area is stored with 2 decimal places
    ];

    /**
     * Get all images for the property.
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * Get the primary image for the property.
     */
    public function primaryImage()
    {
        return $this->morphOne(Image::class, 'imageable')->where('is_primary', true);
    }

    /**
     * Get the user that owns the property.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include published properties.
     */
    public function scopePublished($query)
    {
        return $query->where('is_publish', true);
    }

    /**
     * Scope a query to only include draft properties.
     */
    public function scopeDraft($query)
    {
        return $query->where('is_publish', false);
    }
    public function scopeOwnedBy($query, $userId)
{
    return $query->where('user_id', $userId);
}
}
