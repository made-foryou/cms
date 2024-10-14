<?php

namespace Made\Cms\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Made\Cms\Database\Seeders\CmsCoreSeeder;
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
     */
    public function handle(): int
    {
        $this->info('Configuring Made CMS...');

        $role = $this->defaultRole();

        if (empty($role)) {
            Artisan::call('db:seed', [
                '--class' => CmsCoreSeeder::class,
                '--force' => true,
            ]);

            $role = $this->defaultRole();
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
}
