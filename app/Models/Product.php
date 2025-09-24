<?php

namespace App\Models;

use App\Enums\Level;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

use App\Models\Traits\SelfHealingSlug;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use SelfHealingSlug;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'category_id',
        'tax_class_id',
        'price',
        'is_featured',
        'thumbnail',
        'status',
        'stock',
        'track_quantity',
        'sku',
        'meta_title',
        'meta_description',
        'meta_keywords',

    ];

    protected $casts = [
        'price' => 'array',
    ];

  

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function taxClass()
    {
        return $this->belongsTo(\App\Models\TaxClass::class);
    }

    /**
     * Scope for featured products
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

   



 


    

    /**
     * Get display price based on selected type
     */
    public function getDisplayPrice($type = 'unit'): string
    {
        $price = $this->getPrice($type);
        return '$' . number_format($price, 2);
    }

    /*
     * Get image URL for frontend display
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->thumbnail) {
            // If thumbnail is a full URL, return it directly
            if (filter_var($this->thumbnail, FILTER_VALIDATE_URL)) {
                return $this->thumbnail;
            }

            // If thumbnail is a local path, return the storage URL
            return asset('storage/' . $this->thumbnail);
        }

        // Return a placeholder image if no thumbnail
        return 'https://via.placeholder.com/300x200?text=No+Image';
    }
}
