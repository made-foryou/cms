<?php

namespace Made\Cms\Page\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Made\Cms\Database\Factories\PageFactory;
use Made\Cms\Language\Models\Language;
use Made\Cms\Models\User;
use Made\Cms\Page\QueryBuilders\PageQueryBuilder;
use Made\Cms\Shared\Contracts\DefinesCreatedByContract;
use Made\Cms\Shared\Contracts\HasMeta;
use Made\Cms\Shared\Contracts\RouteableContract;
use Made\Cms\Shared\Database\HasDatabaseTablePrefix;
use Made\Cms\Shared\Enums\PublishingStatus;
use Made\Cms\Shared\Models\Meta;
use Made\Cms\Shared\Models\Route;
use Made\Cms\Shared\Observers\CreatedByDefiningObserver;
use Made\Cms\Shared\Observers\RouteableObserver;

/**
 * @property-read int $id
 * @property int|null $parent_id
 * @property int|null $translated_from_id
 * @property string $name
 * @property string $slug
 * @property int|null $language_id
 * @property PublishingStatus $status
 * @property array $content
 * @property int $sort
 * @property int $author_id
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read Carbon|null $deleted_at
 * @property-read User $author
 * @property-read Meta|null $meta
 * @property-read Language|null $language
 * @property-read Page|null $parent
 * @property-read Collection<Page> $children
 * @property-read Page|null $translatedFrom
 * @property-read Collection<Page> $translations
 * @property-read Route|null $route
 *
 * @method static PageQueryBuilder query()
 */
#[ObservedBy([CreatedByDefiningObserver::class, RouteableObserver::class])]
class Page extends Model implements DefinesCreatedByContract, HasMeta, RouteableContract
{
    use HasDatabaseTablePrefix;
    use HasFactory;
    use SoftDeletes;

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
        'status' => PublishingStatus::class,
        'content' => 'array',
        'sort' => 'integer',
        'created_by' => 'integer',
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
        'sort',
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
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Defines a polymorphic one-to-one relation to the Route model.
     *
     * @return MorphOne The morph one relation instance.
     */
    public function route(): MorphOne
    {
        return $this->morphOne(Route::class, 'routeable');
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
     * Constructs the URL schema by traversing the hierarchy of parent objects.
     * The method modifies the provided array reference to include the slug of each parent object.
     *
     * @param  array  $parts  Reference to an array that accumulates the URL parts.
     *                        Defaults to an empty array.
     * @return array The array of URL parts including the slugs from the hierarchy.
     */
    public function urlSchema(array &$parts = []): array
    {
        if ($this->parent !== null) {
            $parts = $this->parent->urlSchema($parts);
        }

        $parts[] = $this->slug;

        return $parts;
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

    /**
     * {@inheritDoc}
     */
    public function linkName(): string
    {
        return $this->getAttribute('name');
    }

    /**
     * {@inheritDoc}
     */
    public function linkKey(): string
    {
        return 'page';
    }

    /**
     * {@inheritDoc}
     */
    public function linkGroupName(): string
    {
        return __('made-cms::cms.resources.page.label');
    }

    /**
     * {@inheritDoc}
     */
    public function scopeForLinkSelection(Builder $query): Builder
    {
        /** @var PageQueryBuilder $query */
        return $query
            ->select(['id', 'name'])
            ->published();
    }

    /**
     * {@inheritDoc}
     */
    public function newEloquentBuilder($query): PageQueryBuilder
    {
        return new PageQueryBuilder($query);
    }

    /**
     * {@inheritDoc}
     */
    protected static function newFactory(): PageFactory
    {
        return PageFactory::new();
    }
}
