<?php

declare(strict_types=1);

namespace Made\Cms\Website\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;
use Made\Cms\Database\Factories\MenuItemFactory;
use Made\Cms\Shared\Database\HasDatabaseTablePrefix;
use Made\Cms\Website\Builders\MenuItemBuilder;

/**
 * @property-read int $id
 * @property int|null $parent_id
 * @property string $location
 * @property string $linkable_type
 * @property int $linkable_id
 * @property null|string $link
 * @property null|string $label
 * @property null|string $title
 * @property array $rel
 * @property string|null $target
 * @property int $index
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 *
 * @method static MenuItemBuilder query()
 */
class MenuItem extends Model
{
    use HasDatabaseTablePrefix;
    use HasFactory;

    public const string TABLE_NAME = 'menu_items';

    protected $casts = [
        'id' => 'integer',
        'parent_id' => 'integer',
        'linkable_id' => 'integer',
        'rel' => 'array',
        'index' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $fillable = [
        'parent_id',
        'location',
        'linkable_type',
        'linkable_id',
        'link',
        'label',
        'title',
        'rel',
        'target',
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
     * Gets the current link name according to the selected data.
     */
    public function linkName(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->linkable !== null) {
                    return $this->linkable->name;
                }

                return $this->label ?? '';
            }
        );
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

    /**
     * Retrieves the prefixed table name.
     *
     * This method returns the prefixed table name by calling the `prefixTableName` method with the current table name as the argument.
     *
     * @return string The prefixed table name.
     */
    public function getTable(): string
    {
        return $this->prefixTableName(self::TABLE_NAME);
    }

    /**
     * {@inheritDoc}
     */
    public function newEloquentBuilder($query): MenuItemBuilder
    {
        return new MenuItemBuilder($query);
    }

    protected static function newFactory(): MenuItemFactory
    {
        return MenuItemFactory::new();
    }
}
