<?php

namespace Made\Cms\Database\Seeders;

use Illuminate\Database\Seeder;
use Made\Cms\Exceptions\MissingDefaultRoleException;
use Made\Cms\Helpers\Permissions;
use Made\Cms\Models\Role;
use Made\Cms\Models\User;

class CmsCoreSeeder extends Seeder
{
    /**
     * Creates the main role for the application, makes it the default role, and returns it.
     *
     * @return Role The main role created and set as default.
     */
    protected function mainRole(): Role
    {
        $role = Role::create([
            'name' => config('made-cms.setup.super_role.name'),
            'description' => config('made-cms.setup.super_role.description'),
        ]);

        $role->makeDefault();

        return $role;
    }

    /**
     * Creates a series of permissions for user actions in the CMS.
     *
     * @throws MissingDefaultRoleException
     */
    protected function userPermissions(): void
    {
        Permissions::create(
            key: 'user.access_panel',
            subject: User::class,
            name: 'CMS Access',
            description: 'Provides access to the CMS.',
        );

        Permissions::create(
            key: 'user.view_any',
            subject: User::class,
            name: 'View all users',
            description: 'Can list the users of the cms panel.',
        );

        Permissions::create(
            key: 'user.view',
            subject: User::class,
            name: 'View a user',
            description: 'Can view a single user.',
        );

        Permissions::create(
            key: 'user.create',
            subject: User::class,
            name: 'Create a user',
            description: 'Can create a new user.',
        );

        Permissions::create(
            key: 'user.update',
            subject: User::class,
            name: 'Update a user',
            description: 'Can update a user.',
        );

        Permissions::create(
            key: 'user.delete',
            subject: User::class,
            name: 'Delete a user',
            description: 'Can delete a user.',
        );

        Permissions::create(
            key: 'user.restore',
            subject: User::class,
            name: 'Restore a user',
            description: 'Can restore a user.',
        );

        Permissions::create(
            key: 'user.force_delete',
            subject: User::class,
            name: 'Force delete a user',
            description: 'Can force delete a user.',
        );
    }

    /**
     * Sets up the permissions related to roles within the CMS panel.
     *
     * @throws MissingDefaultRoleException
     */
    protected function rolePermissions(): void
    {
        Permissions::create(
            key: 'role.view_any',
            subject: Role::class,
            name: 'View all roles',
            description: 'Can list the roles of the cms panel.',
        );

        Permissions::create(
            key: 'role.view',
            subject: Role::class,
            name: 'View a role',
            description: 'Can view a single role.',
        );

        Permissions::create(
            key: 'role.create',
            subject: Role::class,
            name: 'Create a role',
            description: 'Can create a new role.',
        );

        Permissions::create(
            key: 'role.update',
            subject: Role::class,
            name: 'Update a role',
            description: 'Can update a role.',
        );

        Permissions::create(
            key: 'role.delete',
            subject: Role::class,
            name: 'Delete a role',
            description: 'Can delete a role.',
        );

        Permissions::create(
            key: 'role.restore',
            subject: Role::class,
            name: 'Restore a role',
            description: 'Can restore a role.',
        );

        Permissions::create(
            key: 'role.force_delete',
            subject: Role::class,
            name: 'Force delete a role',
            description: 'Can force delete a role.',
        );
    }

    /**
     * Executes the setup tasks for the application, including creating the main role,
     * assigning user permissions, and setting role permissions.
     *
     * @throws MissingDefaultRoleException
     */
    public function run(): void
    {
        $this->mainRole();

        $this->userPermissions();

        $this->rolePermissions();
    }
}
