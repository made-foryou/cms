<?php

namespace Made\Cms\Tests;

use BladeUI\Heroicons\BladeHeroiconsServiceProvider;
use BladeUI\Icons\BladeIconsServiceProvider;
use Filament\Actions\ActionsServiceProvider;
use Filament\FilamentServiceProvider;
use Filament\Forms\FormsServiceProvider;
use Filament\Infolists\InfolistsServiceProvider;
use Filament\Notifications\NotificationsServiceProvider;
use Filament\Support\SupportServiceProvider;
use Filament\Tables\TablesServiceProvider;
use Filament\Widgets\WidgetsServiceProvider;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\LivewireServiceProvider;
use Made\Cms\CmsServiceProvider;
use Made\Cms\Providers\CmsPanelServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use RyanChandler\BladeCaptureDirective\BladeCaptureDirectiveServiceProvider;
use Spatie\LaravelSettings\LaravelSettingsServiceProvider;
use Spatie\MediaLibrary\MediaLibraryServiceProvider;

class TestCase extends Orchestra
{
    use RefreshDatabase;

    protected $loadEnvironmentVariables = false;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Get the package service providers that should be registered.
     *
     * @param  Application  $app  The application instance.
     * @return array The list of package service providers to be registered.
     */
    protected function getPackageProviders($app): array
    {
        return [
            ActionsServiceProvider::class,
            BladeCaptureDirectiveServiceProvider::class,
            BladeHeroiconsServiceProvider::class,
            BladeIconsServiceProvider::class,
            FilamentServiceProvider::class,
            FormsServiceProvider::class,
            InfolistsServiceProvider::class,
            LivewireServiceProvider::class,
            NotificationsServiceProvider::class,
            SupportServiceProvider::class,
            TablesServiceProvider::class,
            WidgetsServiceProvider::class,
            LaravelSettingsServiceProvider::class,
            MediaLibraryServiceProvider::class,
            CmsServiceProvider::class,
            CmsPanelServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        tap($app['config'], function (Repository $config) {
            $config->set('database.default', 'testing');
            $config->set('database.connections.testing', [
                'driver' => 'sqlite',
                'database' => ':memory:',
            ]);

            $config->set(
                'settings.repositories.database.table',
                $config->get('made-cms.database.table_prefix') . 'settings'
            );
        });
    }

    protected function getApplicationTimezone($app)
    {
        return 'Europe/Amsterdam';
    }

    /**
     * Set up the environment for testing.
     *
     * @param  Application  $app  The application instance.
     */
    public function getEnvironmentSetUp($app): void {}
}
