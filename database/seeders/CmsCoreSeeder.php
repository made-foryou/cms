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
     * @throws MissingDefaultRoleException
     */
    public function run(): void
    {
        $role = Role::create([
            'name' => 'Administrator',
            'description' => 'Main role of the Made CMS. This is the default role which gets access to all permissions.',
        ]);

        $role->makeDefault();

        // Access to the panel
        Permissions::create(
            'accessPanel',
            User::class,
            'Access to the cms panel.',
            'This permission gives you access to the cms panel. You need this permission to log into the panel.',
        );
    }
}
