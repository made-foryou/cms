<?php

namespace Made\Cms\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Made\Cms\CmsServiceProvider;
use Made\Cms\Database\Seeders\CmsCoreSeeder;
use Made\Cms\Language\Actions\MakeLanguageDefault;
use Made\Cms\Language\Models\Language;
use Made\Cms\Models\Role;
use Made\Cms\Models\User;

class InstallCommand extends Command
{
    protected $signature = 'made-cms:install';

    protected $description = 'Installs the package and publishes all necessary files and ';

    /**
     * @var array|array[] Default data for the language models according the selected choice.
     */
    protected array $languageData = [
        'Nederlands' => [
            'name' => 'Nederlands',
            'country' => 'Nederland',
            'locale' => 'nl_NL',
            'abbreviation' => 'nl',
        ],
        'English' => [
            'name' => 'English',
            'country' => 'United kingdom',
            'locale' => 'en_UK',
            'abbreviation' => 'en',
        ],
        'Deutsch' => [
            'name' => 'Deutsch',
            'country' => 'Deutschland',
            'locale' => 'de_DE',
            'abbreviation' => 'de',
        ],
        'Français' => [
            'name' => 'Français',
            'country' => 'France',
            'locale' => 'fr_FR',
            'abbreviation' => 'fr',
        ],
    ];

    public function handle(): void
    {
        if (! $this->option('no-interaction')) {
            $this->info('Thank you for using Made CMS.');
            $this->info('We\'re going to install the package and publish all necessary files.');

            $this->info('First we have to make sure that Filament is installed.');
        }

        $this->call('filament:install', [
            '--no-interaction' => $this->option('no-interaction'),
        ]);

        if (! $this->option('no-interaction')) {
            $this->info('Installed Filament.');
        }

        $this->callSilently('vendor:publish', [
            '--provider' => 'Spatie\MediaLibrary\MediaLibraryServiceProvider',
            '--tag' => 'medialibrary-migrations',
            '--no-interaction' => $this->option('no-interaction'),
        ]);

        $this->callSilently('vendor:publish', [
            '--provider' => CmsServiceProvider::class,
            '--tag' => 'made-cms-config',
            '--no-interaction' => $this->option('no-interaction'),
        ]);

        $this->callSilently('vendor:publish', [
            '--provider' => CmsServiceProvider::class,
            '--tag' => 'cms-views',
            '--no-interaction' => $this->option('no-interaction'),
        ]);

        if (! $this->option('no-interaction')) {
            $this->info('Published CMS config, resources and migrations.');
        }

        $this->call('migrate', [
            '--no-interaction' => $this->option('no-interaction'),
        ]);

        if (! $this->option('no-interaction')) {
            $this->info('The database is fully migrated.');

            $this->info('Let\'s create the default data.');
        }

        $role = $this->defaultRole();
        if (empty($role)) {
            if (! $this->option('no-interaction')) {
                $this->info('Creating a default admin role.');
            }

            $this->call('db:seed', [
                '--class' => CmsCoreSeeder::class,
                '--force' => true,
                '--no-interaction' => $this->option('no-interaction'),
            ]);

            if (! $this->option('no-interaction')) {
                $this->info('Default role and every permission have been added to the database.');
            }

            $role = $this->defaultRole();
        }

        $language = $this->defaultLanguage();

        if (empty($language)) {
            if (! $this->option('no-interaction')) {
                $this->info('Creating default language...');
            }

            $language = $this->createDefaultLanguage();

            if (! $this->option('no-interaction')) {
                $this->info('Default language ' . $language->name . ' created!');
            }
        }

        if (! $this->option('no-interaction')) {
            $createUser = $this->confirm('Do you want to create an admin user?', true);

            if (! $createUser) {
                $this->end();

                return;
            }
        } else {
            return;
        }

        $name = $this->ask('What is the persons name?');

        $email = $this->ask('What is the persons mail address?');

        $password = $this->secret('What password will it be using?');

        $user = new User([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $user->role()->associate($role);

        $user->email_verified_at = now();

        $user->save();

        $this->info('The user has been created!');

        $this->end();
    }

    protected function end(): void
    {
        $this->info('Made CMS is installed, Thank you for installing Made CMS!');
        $this->info('Greetings from Made');
    }

    /**
     * Retrieves the default role from the database.
     *
     * This method queries the database to find the role that is set as the default role.
     * The default role is determined based on the 'is_default' flag in the 'roles' table.
     *
     * @return Role|null The default role, or null if no default role is found.
     */
    protected function defaultRole(): ?Role
    {
        return Role::query()
            ->default()
            ->first();
    }

    /**
     * Retrieves the default language from the database.
     *
     * @return Language|null The default language instance or null if not found.
     */
    protected function defaultLanguage(): ?Language
    {
        return Language::query()
            ->default()
            ->first();
    }

    /**
     * Creates and sets a default language based on user selection.
     *
     * @return Language The newly created default Language instance.
     */
    protected function createDefaultLanguage(): Language
    {
        if (! $this->option('no-interaction')) {
            $choice = $this->choice(
                'Which language do you want to use as default?',
                array_keys($this->languageData),
                'Nederlands',
            );
        } else {
            $choice = 'Nederlands';
        }

        $language = new Language($this->languageData[$choice]);
        $language->is_enabled = true;
        $language->save();

        MakeLanguageDefault::run($language);

        try {
            $language
                ->addMedia(__DIR__ . '/../../../resources/images/flags/' . $language->abbreviation . '.png')
                ->preservingOriginal()
                ->toMediaCollection('flag');
        } catch (\Exception $e) {
        }

        $language->refresh();

        return $language;
    }
}
