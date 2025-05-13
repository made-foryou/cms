<?php

declare(strict_types=1);

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        if ($this->migrator->exists('web.privacy_policy_page')) {
            return;
        }

        $this->migrator->add('web.privacy_policy_page');
        $this->migrator->add('web.cookie_statement_page');

    }
};
