<?php

namespace Made\Cms\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Made\Cms\Exceptions\MissingDefaultRoleException;
use Made\Cms\Models\Permission;
use Made\Cms\Models\Role;

/**
 * @mixin Builder
 */
class Permissions
{
    /**
     * Creates a new permission and give the default admin role access
     * to the permission.
     *
     * @param  string  $key  The key of the permission.
     * @param  string  $subject  The subject of the permission.
     * @param  string|null  $name  The name of the permission.
     * @param  string|null  $description  The description of the permission.
     *
     * @throws MissingDefaultRoleException
     */
    public static function create(
        string $key,
        string $subject,
        ?string $name = null,
        ?string $description = null,
    ): void {
        $permission = Permission::query()->firstOrCreate([
            'key' => $key,
            'subject' => $subject,
            'name' => $name,
            'description' => $description,
        ]);

        self::defaultRole()->permissions()->attach($permission);
    }

    /**
     * Retrieves the default role from the database.
     *
     * @return Role The default role.
     *
     * @throws MissingDefaultRoleException If there is no default role defined in the database.
     */
    protected static function defaultRole(): Role
    {
        $role = Role::query()->default()->first();

        if (! $role) {
            throw new MissingDefaultRoleException;
        }

        return $role;
    }
}
