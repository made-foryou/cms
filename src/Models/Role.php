<?php

namespace Made\Cms\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use Made\Cms\Database\Factories\RoleFactory;
use Made\Cms\Database\HasDatabaseTablePrefix;
use Made\Cms\QueryBuilders\RoleQueryBuilder;

/**
 * ### Role
 *
 * The role model which is being used for the cms roles.
 *
 * @property-read int $id
 * @property string $name
 * @property string|null $description
 * @property bool $is_default
 * @property Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read Carbon|null $deleted_at
 * @property-read Collection<Permission> $permissions
 * @property-read Collection<User> $users
 * @property-read Collection<Permission> $userPermissions
 * @property-read Collection<Permission> $rolePermissions
 *
 * @method static Role create(array $attributes = [])
 * @method static RoleQueryBuilder query()
 */
class Role extends Model
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
        'is_default' => 'boolean',
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
        'name',
        'description',
    ];

    /**
     * Make the current role the default role.
     *
     * This method sets the 'is_default' property of the current role to true
     * and saves the changes to the database. It also updates the
     * 'is_default' property of all other roles to false.
     *
     * This function will reset the current default role, as there can only
     * be one default role.
     */
    public function makeDefault(): void
    {
        Role::query()
            ->where('is_default', true)
            ->update(['is_default' => false]);

        $this->is_default = true;
        $this->save();
    }

    /**
     * Get the permissions associated with the role.
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Permission::class,
            table: $this->prefixTableName('permission_role')
        );
    }

    /**
     * Retrieve the permissions associated with the user.
     *
     * This method returns the permissions that are specifically assigned
     * to the given user, filtered by the subject type `User::class`.
     *
     * @return BelongsToMany The set of permissions for the user.
     */
    public function userPermissions(): BelongsToMany
    {
        return $this->permissions()->where('subject', User::class);
    }

    /**
     * Retrieve the permissions associated with the roles.
     *
     * This method returns the permissions that are specifically assigned
     * to the given user, filtered by the subject type `Role::class`.
     *
     * @return BelongsToMany The set of permissions for the user.
     */
    public function rolePermissions(): BelongsToMany
    {
        return $this->permissions()->where('subject', Role::class);
    }

    /**
     * Retrieves the collection of users associated with this instance.
     *
     * @return HasMany The relationship instance that provides access to the collection of users.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
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
        return $this->prefixTableName('roles');
    }

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): RoleFactory
    {
        return RoleFactory::new();
    }

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param  Builder  $query
     */
    public function newEloquentBuilder($query): RoleQueryBuilder
    {
        return new RoleQueryBuilder($query);
    }
}
