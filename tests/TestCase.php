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
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Application;
use Livewire\LivewireServiceProvider;
use Made\Cms\CmsServiceProvider;
use Made\Cms\Database\Seeders\CmsCoreSeeder;
use Made\Cms\Providers\CmsPanelServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use RyanChandler\BladeCaptureDirective\BladeCaptureDirectiveServiceProvider;
use Spatie\LaravelSettings\LaravelSettingsServiceProvider;
use Spatie\MediaLibrary\MediaLibraryServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Made\\Cms\\Database\\Factories\\' . class_basename($modelName) . 'Factory'
        );

        $this->seed(CmsCoreSeeder::class);
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

    /**
     * Set up the environment for testing.
     *
     * @param  Application  $app  The application instance.
     */
    public function getEnvironmentSetUp($app): void
    {
        $directory = __DIR__ . '/../database/migrations/';
        $files = scandir($directory);

        foreach ($files as $file) {
            if (str_ends_with($file, '.php')) {
                $migration = include $directory . $file;

                $migration->up();
            }
        }

        $directory = __DIR__ . '/../database/settings/';
        $files = scandir($directory);

        foreach ($files as $file) {
            if (str_ends_with($file, '.php')) {
                $migration = include $directory . $file;

                $migration->up();
            }
        }
    }
}
