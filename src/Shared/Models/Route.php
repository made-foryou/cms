<?php

declare(strict_types=1);

namespace Made\Cms\Shared\Models;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;
use Made\Cms\Database\Factories\RouteFactory;
use Made\Cms\Page\Models\Page;
use Made\Cms\Shared\Database\HasDatabaseTablePrefix;
use Made\Cms\Shared\Observers\RouteObserver;

/**
 * @property-read int $id
 * @property-read string $routeable_type
 * @property-read int $routeable_id
 * @property string $route
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read Page $routeable
 *
 * @method static RouteFactory factory()
 */
#[ObservedBy(RouteObserver::class)]
class Route extends Model
{
    use HasDatabaseTablePrefix;
    use HasFactory;

    protected $fillable = [
        'route',
    ];

    protected $casts = [
        'id' => 'integer',
        'routeable_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * {@inheritDoc}
     */
    public function getTable(): string
    {
        return $this->prefixTableName('routes');
    }

    /**
     * Define a polymorphic, inverse one-to-one or many relationship.
     *
     * @return MorphTo The morphable relation instance.
     */
    public function routeable(): MorphTo
    {
        return $this->morphTo();
    }

    protected static function newFactory(): RouteFactory
    {
        return RouteFactory::new();
    }
}
