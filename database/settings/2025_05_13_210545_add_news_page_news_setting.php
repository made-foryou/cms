<?php

declare(strict_types=1);

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        if (!$this->migrator->exists('news.news_page')) {
            $this->migrator->add('news.news_page');
        }
    }
};
