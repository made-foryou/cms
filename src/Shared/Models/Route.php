<?php

declare(strict_types=1);

namespace Made\Cms\Shared\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;
use Made\Cms\Database\HasDatabaseTablePrefix;
use Made\Cms\Models\Page;

/**
 * @property-read int $id
 * @property-read string $routeable_type
 * @property-read int $routeable_id
 * @property string $route
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read Page $routeable
 */
class Route extends Model
{
    use HasDatabaseTablePrefix;

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
}
