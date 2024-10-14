<?php

namespace Made\Cms;

use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Livewire\Features\SupportTesting\Testable;
use Made\Cms\Commands\MadeCmsSetupCommand;
use Made\Cms\Models\Policies\RolePolicy;
use Made\Cms\Models\Policies\UserPolicy;
use Made\Cms\Models\Role;
use Made\Cms\Models\User;
use Made\Cms\Testing\TestsCms;
use ReflectionException;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CmsServiceProvider extends PackageServiceProvider
{
    public static string $name = 'made-cms';

    public static string $viewNamespace = 'cms';

    /**
     * Configures the given package by setting its name, commands, install command,
     * config file, migrations, translations, and views.
     *
     * @param  Package  $package  The package to be configured.
     *
     * @see https://github.com/spatie/laravel-package-tools
     */
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)
            ->hasCommands($this->getCommands())
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->askToRunMigrations();
            });

        $configFileName = $package->shortName();

        if (file_exists($package->basePath("/../config/$configFileName.php"))) {
            $package->hasConfigFile();
        }

        if (file_exists($package->basePath('/../database/migrations'))) {
            $package->hasMigrations($this->getMigrations());
        }

        if (file_exists($package->basePath('/../resources/lang'))) {
            $package->hasTranslations();
        }

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }

    /**
     * Executes the actions required when a package is registered.
     *
     * This method should be implemented to perform any necessary tasks when a package is registered in the software.
     * Examples of such tasks might include initializing package-specific settings, registering routes or event listeners,
     * or any other initialization or configuration steps required by the package.
     */
    public function packageRegistered(): void {}

    /**
     * Handles various tasks after the package has booted, including asset registration,
     * icon registration, stub handling, and testing.
     *
     * @throws ReflectionException
     */
    public function packageBooted(): void
    {
        // Installing the made_cms guard for the panel authentication.
        Config::set('auth.guards.made', [
            'driver' => 'session',
            'provider' => 'made',
        ]);

        Config::set('auth.providers.made', [
            'driver' => 'eloquent',
            'model' => User::class,
        ]);

        // Registering policies
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Role::class, RolePolicy::class);

        // Asset Registration
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

        FilamentAsset::registerScriptData(
            $this->getScriptData(),
            $this->getAssetPackageName()
        );

        // Icon Registration
        FilamentIcon::register($this->getIcons());

        // Handle Stubs
        if (app()->runningInConsole()) {
            foreach (app(Filesystem::class)->files(__DIR__ . '/../stubs/') as $file) {
                $this->publishes([
                    $file->getRealPath() => base_path("stubs/cms/{$file->getFilename()}"),
                ], 'cms-stubs');
            }
        }

        // Testing
        Testable::mixin(new TestsCms);
    }

    /**
     * Returns the name of the asset package, which is 'made-foryou/cms'.
     * This method is used to get the package name for assets such as CSS, JavaScript, or images.
     *
     * @return string|null The name of the asset package.
     */
    protected function getAssetPackageName(): ?string
    {
        return 'made-foryou/cms';
    }

    /**
     * Retrieves the assets for the package.
     *
     * This method returns an array of assets, including CSS and JS files,
     * necessary for the package to function properly. These assets are located
     * in the package's "resources/dist" directory.
     *
     * @return array<Asset> The array of assets for the package.
     */
    protected function getAssets(): array
    {
        return [
            // AlpineComponent::make('cms', __DIR__ . '/../resources/dist/components/cms.js'),
            Css::make('cms-styles', __DIR__ . '/../resources/dist/cms.css'),
            Js::make('cms-scripts', __DIR__ . '/../resources/dist/cms.js'),
        ];
    }

    /**
     * Retrieves the list of commands for the package.
     *
     * @return array<class-string> The array of command classes.
     */
    protected function getCommands(): array
    {
        return [
            MadeCmsSetupCommand::class,
        ];
    }

    /**
     * Returns an array of icons.
     *
     * @return array<string>
     */
    protected function getIcons(): array
    {
        return [];
    }

    /**
     * Returns the routes for the package.
     *
     * @return array<string> An array of routes for the package.
     */
    protected function getRoutes(): array
    {
        return [];
    }

    /**
     * Retrieves the script data.
     *
     * @return array<string> The script data.
     */
    protected function getScriptData(): array
    {
        return [];
    }

    /**
     * Returns the list of migrations required by the package.
     *
     * @return array<string> The array of migration names.
     */
    protected function getMigrations(): array
    {
        return [
            '2024_09_25_175617_create_made_cms_users_table',
            '2024_09_25_175647_create_made_cms_roles_tables',
        ];
    }
}
