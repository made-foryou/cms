<?php

namespace Made\Cms\Database\Seeders;

use Illuminate\Database\Seeder;
use Made\Cms\Models\Permission;
use Made\Cms\Models\Role;
use Made\Cms\Models\User;

class CmsCoreSeeder extends Seeder
{
    public function run(): void
    {
        $role = Role::create([
            'name' => 'Administrator',
            'description' => 'Main role of the Made CMS. This is the default role which gets access to all permissions.',
        ]);

        $role->makeDefault();

        // Access to the panel
        $permission = Permission::query()->firstOrCreate([
            'key' => 'accessPanel',
            'subject' => User::class,
            'name' => 'Access to the cms panel.',
            'description' => 'This permission gives you access to the cms panel. You need this permission to log into the panel.',
        ]);
        $role->permissions()->attach($permission);
    }
}
