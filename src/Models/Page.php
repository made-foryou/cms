<?php

namespace Made\Cms\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Made\Cms\Database\HasDatabaseTablePrefix;
use Made\Cms\Enums\PageStatus;
use Made\Cms\Observers\PageModelObserver;

/**
 * @property-read int $id
 * @property-read int|null $parent_id
 * @property string $name
 * @property string $slug
 * @property string $locale
 * @property PageStatus $status
 * @property array $content
 * @property int $author_id
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read Carbon|null $deleted_at
 * @property-read User $author
 */
#[ObservedBy(PageModelObserver::class)]
class Page extends Model
{
    use HasDatabaseTablePrefix;
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'parent_id' => 'integer',
        'status' => PageStatus::class,
        'content' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'locale',
        'status',
        'content',
    ];

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'content' => '[]',
    ];

    /**
     * Establishes a relationship to the parent page.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(
            related: Page::class,
            foreignKey: 'parent_id'
        );
    }

    /**
     * The relation to the child pages.
     *
     * @return HasMany The relationship instance.
     */
    public function children(): HasMany
    {
        return $this->hasMany(
            related: Page::class,
            foreignKey: 'parent_id'
        );
    }

    /**
     * Defines the relationship between this model and the User model.
     *
     * This method establishes a "belongs to" relationship, indicating that this model is associated with an instance of the User model through the 'author' foreign key.
     *
     * @return BelongsTo The relationship instance between this model and the User model.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * The relation to the metadata for the page.
     */
    public function meta(): MorphOne
    {
        return $this->morphOne(Meta::class, 'describable');
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
        return $this->prefixTableName('pages');
    }
}
