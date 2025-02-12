<?php

declare(strict_types=1);

namespace Made\Cms\Website\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

/**
 * @property-read int $id
 * @property int|null $parent_id
 * @property string $location
 * @property string $linkable_type
 * @property int $linkable_id
 * @property null|string $link
 * @property null|string $title
 * @property null|string $rel
 * @property int $index
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 */
class MenuItem extends Model
{
    protected $table = 'menu_items';

    protected $fillable = [
        'parent_id',
        'location',
        'linkable_type',
        'linkable_id',
        'link',
        'title',
        'rel',
        'index',
    ];

    /**
     * Get the parent linkable model (morph-to relationship).
     *
     * This method defines a polymorphic relationship, allowing the MenuItem
     * model to be associated with multiple other models.
     */
    public function linkable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the parent menu item.
     *
     * This function defines a relationship where a menu item belongs to a parent menu item.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    /**
     * Get the children menu items for the current menu item.
     *
     * This method defines a one-to-many relationship between the current menu item
     * and its child menu items. It returns a HasMany relationship instance.
     */
    public function children(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'parent_id');
    }
}
