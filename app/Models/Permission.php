<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'display_name',
        'description',
        'group',
    ];

    /**
     * Get the roles that have this permission.
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Scope to filter by group.
     */
    public function scopeByGroup($query, $group)
    {
        return $query->where('group', $group);
    }

    /**
     * Get all permission groups.
     */
    public static function getGroups(): array
    {
        return static::distinct()->pluck('group')->toArray();
    }

    /**
     * Check if permission exists by name.
     */
    public static function exists($name): bool
    {
        return static::where('name', $name)->exists();
    }

    /**
     * Create a permission if it doesn't exist.
     */
    public static function findOrCreate($name, $displayName = null, $description = null, $group = 'general'): self
    {
        return static::firstOrCreate(
            ['name' => $name],
            [
                'display_name' => $displayName ?? ucwords(str_replace(['.', '_'], ' ', $name)),
                'description' => $description,
                'group' => $group,
            ]
        );
    }
}
