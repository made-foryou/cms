<?php

namespace Made\Cms\Shared\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Made\Cms\Page\Models\Page;
use Made\Cms\Shared\Database\HasDatabaseTablePrefix;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property-read int $id
 * @property int $describable_id
 * @property string $describable_type
 * @property string $title
 * @property string $description
 * @property string $robot
 * @property array $canonicals
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Page $describable
 */
class Meta extends Model implements HasMedia
{
    use HasDatabaseTablePrefix;
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'robot',
        'canonicals',
    ];

    protected $casts = [
        'id' => 'integer',
        'describable_id' => 'integer',
        'canonicals' => 'array',
        'created' => 'datetime',
        'updated' => 'datetime',
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

    /**
     * Registers media collections for the model.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('meta_image');
    }
}
