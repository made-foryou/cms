<?php

declare(strict_types=1);

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        if ($this->migrator->exists('information.company')) {
            return;
        }

        $this->migrator->add('information.company');
        $this->migrator->add('information.accounts', []);
        $this->migrator->add('information.addresses', []);
        $this->migrator->add('information.contacts', []);

    }
};