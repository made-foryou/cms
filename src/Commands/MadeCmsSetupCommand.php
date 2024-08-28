<?php

namespace Made\Cms\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Made\Cms\Exceptions\MissingDefaultRoleException;
use Made\Cms\Helpers\Permissions;
use Made\Cms\Models\Role;
use Made\Cms\Models\User;

class MadeCmsSetupCommand extends Command
{
    public $signature = 'made-cms:setup';

    public $description = 'Setting up and configuring the Made CMS.';

    /**
     * Executes the handle command.
     *
     * This method is responsible for handling the command execution logic.
     * It configures the Made CMS, creates a default role if it doesn't already exist,
     * prompts the user to enter the person's name, email and password,
     * creates a new User with the provided details,
     * associates the created User with the default Role,
     * saves the User to the database,
     * creates core permissions for the default Role,
     * and returns a success code.
     *
     * @return int The success code indicating the command execution status.
     *
     * @throws MissingDefaultRoleException
     */
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
            'name' => $name ?? __('made-cms::cms.role.default.name'),
            'description' => __('made-cms::cms.role.default.description'),
        ]);

        $role->makeDefault();

        return $role;
    }

    /**
     * Creates the core permissions.
     *
     * This method creates the core permission 'accessPanel' for the User class.
     * The permission is created with a predefined name and description.
     *
     * @throws MissingDefaultRoleException
     */
    protected function createCorePermissions(): void
    {
        Permissions::create(
            'accessPanel',
            User::class,
            __('made-cms::cms.permissions.accessPanel.name'),
            __('made-cms::cms.permissions.accessPanel.description'),
        );
    }
}
