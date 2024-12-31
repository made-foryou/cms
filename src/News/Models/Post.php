<?php

declare(strict_types=1);

namespace Made\Cms\News\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Made\Cms\Database\HasDatabaseTablePrefix;
use Made\Cms\Language\Models\Language;
use Made\Cms\Models\Meta;
use Made\Cms\Models\User;
use Made\Cms\Shared\Contracts\DefinesAuthorContract;
use Made\Cms\Shared\Contracts\RouteableContract;
use Made\Cms\Shared\Enums\PublishingStatus;
use Made\Cms\Shared\Models\Route;
use Made\Cms\Shared\Observers\AuthorDefiningObserver;
use Made\Cms\Shared\Observers\RouteableObserver;

/**
 * @property-read int $id
 * @property int|null $language_id
 * @property int|null $translated_from_id
 * @property string $name
 * @property string $slug
 * @property PublishingStatus $status
 * @property array $content
 * @property int $author_id
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read Carbon|null $deleted_at
 */
#[ObservedBy([AuthorDefiningObserver::class, RouteableObserver::class])]
class Post extends Model implements DefinesAuthorContract, RouteableContract
{
    use HasDatabaseTablePrefix;
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
        'author_id' => 'integer',
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
        'author_id',
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
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
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
        return $this->prefixTableName('posts');
    }
}
