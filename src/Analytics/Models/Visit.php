<?php

declare(strict_types=1);

namespace Made\Cms\Analytics\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Made\Cms\Models\User;
use Made\Cms\Shared\Database\HasDatabaseTablePrefix;
use Made\Cms\Shared\Models\Route;

/**
 * @property-read int $id
 * @property string $session
 * @property-read int|null $user_id
 * @property string $user_agent
 * @property string|null $browser
 * @property string|null $browser_version
 * @property string|null $platform
 * @property bool $is_desktop
 * @property string|null $referer
 * @property string|null $request
 * @property-read int|null $route_id
 * @property string|null $response_code
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read User|null $user
 * @property-read Route|null $route
 *
 * @method static Builder query()
 * @method static Visit create(array $attributes = [])
 */
class Visit extends Model
{
    use HasDatabaseTablePrefix;

    public const string TABLE = 'visits';

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'is_desktop' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $fillable = [
        'session',
        'user_agent',
        'browser',
        'browser_version',
        'platform',
        'is_desktop',
        'referer',
        'response_code',
    ];

    /**
     * Define a one-to-one relationship with the User model.
     *
     * @return BelongsTo The relationship instance linking to the User model.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Defines an inverse one-to-many relationship between the current model and the Route model.
     *
     * @return BelongsTo The relationship instance that defines the association.
     */
    public function route(): BelongsTo
    {
        return $this->belongsTo(Route::class);
    }

    /**
     * {@inheritDoc}
     */
    public function getTable(): string
    {
        return $this->prefixTableName(self::TABLE);
    }
}
