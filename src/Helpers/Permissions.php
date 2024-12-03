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
     * @var array|string[]
     */
    protected static array $modelPermissions = [
        'view_any',
        'view',
        'create',
        'update',
        'delete',
        'restore',
        'force_delete',
    ];

    /**
     * Create permissions entries for a given model based on predefined model permissions.
     *
     * @param  string  $key  The key representing the model.
     * @param  string<class-string>  $subject  The subject associated with the permissions.
     *
     * @throws MissingDefaultRoleException
     */
    public static function createForModel(string $key, string $subject): void
    {
        foreach (self::$modelPermissions as $permission) {
            self::create(
                key: $key . '.' . $permission,
                subject: $subject,
                name: __("made-cms::cms.permissions.{$key}.{$permission}.name"),
                description: __("made-cms::cms.permissions.{$key}.{$permission}.description"),
            );
        }
    }

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
