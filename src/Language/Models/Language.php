<?php

namespace Made\Cms\Language\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Made\Cms\Language\Builders\LanguageBuilder;
use Made\Cms\Models\Page;

/**
 * @property-read int $id
 * @property string $name
 * @property string|null $country
 * @property int $language_id
 * @property string $abbreviation
 * @property string|null $image
 * @property bool $is_default
 * @property bool $is_enabled
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read Carbon|null $deleted_at
 * @property-read Collection<Page> $pages
 *
 * @method static LanguageBuilder query()
 */
class Language extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'country',
        'locale',
        'abbreviation',
        'image',
        'is_default',
        'is_enabled',
    ];

    protected $casts = [
        'id' => 'integer',
        'is_default' => 'boolean',
        'is_enabled' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Establishes a one-to-many relationship with the Page model.
     */
    public function pages(): HasMany
    {
        return $this->hasMany(
            related: Page::class,
            foreignKey: 'language_id'
        );
    }

    /**
     * Retrieves the table name with the applied prefix from the configuration.
     */
    public function getTable(): string
    {
        return config('made-cms.database.table_prefix') . 'languages';
    }

    /**
     * {@inheritDoc}
     */
    public function newEloquentBuilder($query): LanguageBuilder
    {
        return new LanguageBuilder($query);
    }
}
