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
use Made\Cms\Providers\CmsPanelServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use RyanChandler\BladeCaptureDirective\BladeCaptureDirectiveServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Made\\Cms\\Database\\Factories\\' . class_basename($modelName) . 'Factory'
        );
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
        config()->set('database.default', 'sqlite');
        config()->set('app.key', 'base64:NjVnZ292bjJ3dW94NnIxYjV2eG92ZjNpZ3RqZ2tvMzk=');

        $migration = include __DIR__ . '/../database/migrations/create_made_cms_users_table.php.stub';
        $migration->up();

    }
}
