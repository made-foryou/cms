<?php

namespace Made\Cms\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Made\Cms\Database\HasDatabaseTablePrefix;

/**
 * @property-read int $id
 * @property int $describable_id
 * @property string $describable_type
 * @property string $title
 * @property string $description
 * @property string $robot
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Page $describable
 */
class Meta extends Model
{
    use HasDatabaseTablePrefix;

    protected $fillable = [
        'title',
        'description',
        'robot',
    ];

    /**
     * Establishes a polymorphic one-to-one relationship.
     *
     * @return MorphTo The morphOne relationship for the describable page.
     */
    public function describable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Retrieves the prefixed table name.
     *
     * @return string The prefixed table name 'metas'.
     */
    public function getTable(): string
    {
        return $this->prefixTableName('meta');
    }
}
