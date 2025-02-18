<?php

declare(strict_types=1);

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        if ($this->migrator->exists('web.not_found_page')) {
            return;
        }

        $this->migrator->add('web.not_found_page', null);
    }
};
