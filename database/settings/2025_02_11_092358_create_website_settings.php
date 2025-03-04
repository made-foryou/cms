<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        if ($this->migrator->exists('web.online')) {
            return;
        }

        $this->migrator->add('web.online', true);
        $this->migrator->add('web.landing_page');
    }

    public function down(): void 
    {
        $this->migrator->delete('web.online');
        $this->migrator->delete('web.landing_page');
    }
};
