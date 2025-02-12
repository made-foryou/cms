<?php

declare(strict_types=1);

use Made\Cms\Analytics\Enums\VisitSavingStrategy;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        if ($this->migrator->exists('analytics.ip_blacklist')) {
            return;
        }

        $this->migrator->add('analytics.ip_blacklist', []);

        $this->migrator->add(
            'analytics.saving_strategy',
            VisitSavingStrategy::SaveAll->value
        );
    }
};
