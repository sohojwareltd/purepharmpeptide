<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class HeroSlide extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'button_text',
        'button_link',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Boot method to handle image deletion
     */
    protected static function booted()
    {
        static::updating(function ($slide) {
            // If image is being updated, delete old image
            if ($slide->isDirty('image') && $slide->getOriginal('image')) {
                Storage::disk('public')->delete($slide->getOriginal('image'));
            }
        });

        static::deleting(function ($slide) {
            // Delete image when slide is deleted
            if ($slide->image) {
                Storage::disk('public')->delete($slide->image);
            }
        });
    }

    /**
     * Get image URL
     */
    public function getImageUrlAttribute(): string
    {
        if (! $this->image) {
            return 'https://via.placeholder.com/1920x600?text=Hero+Slide';
        }

        // Allow absolute URLs (seeded) and fallback to public storage paths for uploads
        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }

    /**
     * Scope for active slides
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered slides
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
