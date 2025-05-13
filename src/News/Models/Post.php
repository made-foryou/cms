<?php

declare(strict_types=1);

namespace Made\Cms\News\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Made\Cms\Database\Factories\PostFactory;
use Made\Cms\Language\Models\Language;
use Made\Cms\Models\User;
use Made\Cms\News\QueryBuilders\PostQueryBuilder;
use Made\Cms\Shared\Contracts\DefinesCreatedByContract;
use Made\Cms\Shared\Contracts\HasMeta;
use Made\Cms\Shared\Contracts\RouteableContract;
use Made\Cms\Shared\Database\HasDatabaseTablePrefix;
use Made\Cms\Shared\Enums\PublishingStatus;
use Made\Cms\Shared\Models\Meta;
use Made\Cms\Shared\Models\Route;
use Made\Cms\Shared\Observers\CreatedByDefiningObserver;
use Made\Cms\Shared\Observers\RouteableObserver;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property-read int $id
 * @property int|null $language_id
 * @property int|null $translated_from_id
 * @property string $name
 * @property string $slug
 * @property PublishingStatus $status
 * @property array $content
 * @property int $created_by
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read Carbon|null $deleted_at
 *
 * @method static PostQueryBuilder query()
 */
#[ObservedBy([CreatedByDefiningObserver::class, RouteableObserver::class])]
class Post extends Model implements DefinesCreatedByContract, HasMedia, HasMeta, RouteableContract
{
    use HasDatabaseTablePrefix;
    use HasFactory;
    use InteractsWithMedia;
    use SoftDeletes;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'language_id' => 'integer',
        'translated_from_id' => 'integer',
        'name' => 'string',
        'slug' => 'string',
        'status' => PublishingStatus::class,
        'content' => 'array',
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
        'language_id',
        'translated_from_id',
        'name',
        'slug',
        'status',
        'content',
        'created_by',
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
     * Creates and returns a new instance of the PostFactory.
     *
     * @return PostFactory The new factory instance.
     */
    protected static function newFactory(): PostFactory
    {
        return PostFactory::new();
    }

    /**
     * The related page which this was translated from.
     *
     * @returns BelongsTo The relationship instance
     */
    public function translatedFrom(): BelongsTo
    {
        return $this->belongsTo(
            related: Post::class,
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
            related: Post::class,
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
        return 'post';
    }

    /**
     * {@inheritDoc}
     */
    public function linkGroupName(): string
    {
        return __('made-cms::cms.resources.post.label');
    }

    /**
     * {@inheritDoc}
     */
    public function scopeForLinkSelection(PostQueryBuilder | Builder $query): PostQueryBuilder
    {
        return $query->published();
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
        return $this->prefixTableName('posts');
    }

    /**
     * Registers media collections for the model.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image');
    }

    /**
     * Registers media conversions for the model, defining transformation settings for the media.
     *
     * @param  Media|null  $media  An optional Media instance to which the conversions apply.
     * @return void No return value.
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('preview')
            ->fit(Fit::Fill, 300, 300)
            ->nonQueued();
    }

    /**
     * {@inheritDoc}
     */
    public function newEloquentBuilder($query): PostQueryBuilder
    {
        return new PostQueryBuilder($query);
    }
}
