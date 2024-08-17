<?php

namespace Made\Cms\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Made\Cms\Models\User;

class CreateUser extends Command
{
    public $signature = 'made:user';

    public $description = 'Create a super user for the Made CMS.';

    public function handle(): int
    {
        $this->info('Creating a super user.');

        $name = $this->ask('What is the persons name?');

        $email = $this->ask('What is the persons mail address?');

        $password = $this->secret('What password will it be using?');

        $user = new User([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $user->email_verified_at = now();

        $user->save();

        $this->info('The user has been created!');

        return self::SUCCESS;
    }
}
