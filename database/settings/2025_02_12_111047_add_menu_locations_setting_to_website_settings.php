<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        if ($this->migrator->exists('web.menu_locations')) {
            return;
        }

        $this->migrator->add('web.menu_locations', [
            [
                'key' => 'main',
                'name' => 'Hoofdmenu',
                'description' => 'Basis hoofdmenu welke bovenaan de pagina wordt gebruikt.',
            ]
        ]);
    }
};
