<?php

namespace Made\Cms\Database\Seeders;

use Illuminate\Database\Seeder;
use Made\Cms\Exceptions\MissingDefaultRoleException;
use Made\Cms\Helpers\Permissions;
use Made\Cms\Language\Models\Language;
use Made\Cms\Models\Permission;
use Made\Cms\Models\Role;
use Made\Cms\Models\User;
use Made\Cms\Page\Models\Page;
use Made\Cms\Shared\Models\Meta;

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
            name: __('made-cms::cms.permissions.user.access_panel.name'),
            description: __('made-cms::cms.permissions.user.access_panel.description'),
        );

        Permissions::createForModel('user', User::class);
    }

    /**
     * Sets up the permissions related to roles within the CMS panel.
     *
     * @throws MissingDefaultRoleException
     */
    protected function rolePermissions(): void
    {
        Permissions::createForModel('role', Role::class);
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

        Permissions::createForModel('permission', Permission::class);

        Permissions::createForModel('page', Page::class);

        Permissions::createForModel('meta', Meta::class);

        Permissions::createForModel('language', Language::class);
    }
}
