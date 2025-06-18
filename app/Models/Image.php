<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'is_primary',
        'imageable_id',
        'imageable_type'
    ];

    protected $casts = [
        'is_primary' => 'boolean'
    ];

    /**
     * Get the parent imageable model.
     */
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the full URL for the image.
     */
    public function getUrlAttribute(): string
    {
        return $this->path ? asset(Storage::url($this->path)) : $this->getDefaultImageUrl();
    }

    /**
     * Get the default image URL if no image exists.
     */
    protected function getDefaultImageUrl(): string
    {
        return asset('images/default-image.png');
    }

    /**
     * Delete the image file from storage when deleting the model.
     */
    protected static function booted(): void
    {
        static::deleting(function (Image $image) {
            Storage::delete($image->path);
        });
    }
}
