<?php

namespace Made\Cms\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Query\Builder;
use Made\Cms\Database\Factories\PermissionFactory;
use Made\Cms\Database\HasDatabaseTablePrefix;
use Made\Cms\QueryBuilders\PermissionQueryBuilder;

/**
 * ### Permission
 *
 * @property-read int $id
 * @property string $key
 * @property string $subject
 * @property string|null $name
 * @property string|null $description
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read Collection<Role> $roles
 *
 * @method static Permission create(array $attributes = [])
 */
class Permission extends Model
{
    use HasDatabaseTablePrefix;
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'subject',
        'name',
        'description',
    ];

    /**
     * Retrieve the roles which have access to this permission.
     *
     * This method returns a collection of roles that are associated with
     * the permission.
     *
     * @return BelongsToMany A collection of roles.
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            Role::class,
            $this->prefixTableName('permission_role'),
        );
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
        return $this->prefixTableName('permissions');
    }

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param  Builder  $query
     */
    public function newEloquentBuilder($query): PermissionQueryBuilder
    {
        return new PermissionQueryBuilder($query);
    }

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): PermissionFactory
    {
        return PermissionFactory::new();
    }
}
