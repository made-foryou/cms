<?php

namespace Made\Cms\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Made\Cms\Database\HasDatabaseTablePrefix;
use Made\Cms\Enums\PageStatus;
use Made\Cms\Language\Models\Language;
use Made\Cms\Observers\PageModelObserver;

/**
 * @property-read int $id
 * @property int|null $parent_id
 * @property int|null $translated_from_id
 * @property string $name
 * @property string $slug
 * @property int|null $language_id
 * @property PageStatus $status
 * @property array $content
 * @property int $author_id
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read Carbon|null $deleted_at
 * @property-read User $author
 * @property-read Meta|null $meta
 * @property-read Language|null $language
 * @property-read Page|null $parent
 * @property-read Collection<Page> $children
 * @property-read null|Page $translatedFrom
 * @property-read Collection<Page> $translations
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
        'translated_from_id' => 'integer',
        'language_id' => 'integer',
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
        'translated_from_id',
        'name',
        'slug',
        'language_id',
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
     * Defines the relationship to the parent page.
     *
     * @return BelongsTo The associated parent page.
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
     * The related page which this was translated from.
     *
     * @returns BelongsTo The relationship instance
     */
    public function translatedFrom(): BelongsTo
    {
        return $this->belongsTo(
            related: Page::class,
            foreignKey: 'translated_from_id'
        );
    }

    /**
     * Defines a relationship to retrieve all translations of this page.
     *
     * @return HasMany The related translations.
     */
    public function translations(): HasMany
    {
        return $this->hasMany(
            related: Page::class,
            foreignKey: 'translated_from_id',
        );
    }

    /**
     * The relation to the associated language for the model.
     *
     * @return BelongsTo The relationship instance.
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(
            related: Language::class,
            foreignKey: 'language_id',
            ownerKey: 'id',
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
     * Establishes a one-to-one polymorphic relationship with the Meta model.
     *
     * @return MorphOne A MorphOne relationship instance with the Meta model.
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
