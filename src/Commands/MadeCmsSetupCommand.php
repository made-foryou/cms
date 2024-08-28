<?php

namespace Made\Cms\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Made\Cms\Models\Permission;
use Made\Cms\Models\Role;
use Made\Cms\Models\User;

class MadeCmsSetupCommand extends Command
{
    public $signature = 'made-cms:setup';

    public $description = 'Setting up and configuring the Made CMS.';

    public function handle(): int
    {
        $this->info('Configuring Made CMS...');

        $role = $this->defaultRole();

        if (! $role) {
            $role = $this->createDefaultRole();
        }

        $name = $this->ask('What is the persons name?');

        $email = $this->ask('What is the persons mail address?');

        $password = $this->secret('What password will it be using?');

        $user = new User([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $user->role()->associate($role);

        $user->email_verified_at = now();

        $user->save();

        $this->createCorePermissions($role);

        $this->info('The user has been created!');

        return self::SUCCESS;
    }

    /**
     * Retrieves the default role from the database.
     *
     * This method queries the database to find the role that is set as the default role.
     * The default role is determined based on the 'is_default' flag in the 'roles' table.
     *
     * @return Role|null The default role, or null if no default role is found.
     */
    protected function defaultRole(): ?Role
    {
        return Role::query()
            ->default()
            ->first();
    }

    /**
     * Creates the default Role.
     *
     * This method prompts the user to enter a name for the default Role.
     * It then creates a Role with the provided name and predefined description.
     * The created Role is set as the default Role.
     *
     * @return Role The created default Role.
     */
    protected function createDefaultRole(): Role
    {
        $name = $this->ask('What do you want to call the default role?');

        /** @var Role $role */
        $role = Role::create([
            'name' => $name ?? __('cms.role.default.name'),
            'description' => __('cms.role.default.description'),
        ]);

        $role->makeDefault();

        return $role;
    }

    protected function createCorePermissions(Role $role): void
    {
        // Access to the panel
        $permission = Permission::query()->firstOrCreate([
            'key' => 'cms.access',
            'name' => __('cms.permissions.cms.access.name'),
            'description' => __('cms.permissions.cms.access.description'),
        ]);
        $role->permissions()->attach($permission);


    }
}
