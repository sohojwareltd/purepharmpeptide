<?php
namespace App\Models;

use App\Models\Category;
use App\Models\Traits\SelfHealingSlug;
use Illuminate\Database\Eloquent\Model;

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

    public function category()
    {
        return $this->belongsTo(Category::class);
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
    // public function getDisplayPrice(): string
    // {
    //     $price = $this->getPrice();
    //     return '$' . number_format($price, 2);
    // }

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
