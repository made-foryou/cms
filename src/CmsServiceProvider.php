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
use Illuminate\Support\Str;
use Livewire\Features\SupportTesting\Testable;
use Made\Cms\Language\Models\Language;
use Made\Cms\Language\Models\Policies\LanguagePolicy;
use Made\Cms\Models\Permission;
use Made\Cms\Models\Policies\PermissionPolicy;
use Made\Cms\Models\Policies\RolePolicy;
use Made\Cms\Models\Policies\UserPolicy;
use Made\Cms\Models\Role;
use Made\Cms\Models\User;
use Made\Cms\Page\Models\Page;
use Made\Cms\Page\Models\Policies\PagePolicy;
use Made\Cms\Shared\Commands\MadeCmsSetupCommand;
use Made\Cms\Shared\Models\Meta;
use Made\Cms\Shared\Models\Policies\MetaPolicy;
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
                    ->askToRunMigrations()
                    ->askToStarRepoOnGitHub('made-foryou/cms');
            });

        $configFileName = $package->shortName();

        if (file_exists($package->basePath("/../config/$configFileName.php"))) {
            $package->hasConfigFile([
                'made-cms', 'settings',
            ]);
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
        Gate::policy(Permission::class, PermissionPolicy::class);
        Gate::policy(Page::class, PagePolicy::class);
        Gate::policy(Meta::class, MetaPolicy::class);
        Gate::policy(Language::class, LanguagePolicy::class);

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

            foreach (app(Filesystem::class)->files(__DIR__ . '/../database/settings/') as $file) {
                $this->publishes([
                    __DIR__ . "/../database/settings/{$file->getFilename()}" => database_path(
                        '/settings/' . $this->getMigrationName($file->getFilename())
                    ),
                ], 'cms-setting-migrations');
            }
        }

        // Testing
        Testable::mixin(new TestsCms);
    }

    /**
     * Generates a migration file name by appending the current timestamp to the given original file name.
     *
     * @param  string  $original  The original name of the migration file.
     * @return string The generated migration file name with a timestamp prefix.
     */
    protected function getMigrationName(string $original): string
    {
        $filename = Str::replace('.php.stub', '.php', $original);

        return now()->format('Y_m_d_His') . '_' . $filename;
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
            '2024_10_14_144810_create_made_cms_languages_table',
            '2024_10_14_144913_create_made_cms_pages_table',
            '2024_10_29_193733_create_made_cms_meta_table',
            '2024_11_04_174245_create_made_cms_settings_table',
            '2024_12_08_190243_create_made_cms_routes_table',
            '2024_12_30_200702_create_made_cms_posts_table',
            '2025_02_04_150436_create_visits_table',
        ];
    }
}
