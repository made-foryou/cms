# Made CMS

[![Latest Version on Packagist](https://img.shields.io/packagist/v/made-foryou/cms.svg?style=flat-square)](https://packagist.org/packages/made-foryou/cms)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/made-foryou/cms/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/made-foryou/cms/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/made-foryou/cms/fix-php-code-styling.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/made-foryou/cms/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/made-foryou/cms.svg?style=flat-square)](https://packagist.org/packages/made-foryou/cms)

Plugin which provides a Content Management system within Filament.

## Installation

You can install the package via composer:

```bash
composer require made-foryou/cms
```

Next we have to install the plugin and publish its files to the project.

```bash
php artisan made-cms:install
```

### Migration

To generate the database tables that the CMS uses you can perform the following:

> To change the database prefix you first have to change this within the `cms.php` config file.

```bash
php artisan migrate
```

#### Change database prefix

You can change the prefix of the database table names by entering it in the configuration 
file. Keep in mind that once you change this configuration setting you will have to 
migrate the database again. You will also have to run the `made-cms:setup` again to get 
the basic setup back.

> **Keep in mind that the following command clears ur database and generates new and empty tables.**

```bash
php artisan migrate:fresh
```


### Setup core data

To use the CMS panel, there is still a standard setup to be done. This can be done using 
the artisan command below. This command generates, based on your input, an admin user 
with the admin role and basic permissions.

```bash
php artisan made-cms:setup
```

## Config

This is the contents of the published config file:

```php
<?php

// config for Made/Cms
return [

    /**
     * ### Panel
     */
    'panel' => [

        /**
         * ### Panel path
         *
         * Using this setting, you can adjust the path in the URL where the CMS is available.
         *
         * @var string
         */
        'path' => env('MADE_CMS_PANEL_PATH', 'made'),

        /**
         * #### Panel domain
         *
         * This setting ensures that the CMS panel is associated with these
         * domain names.
         *
         * For instance, if you wish to make the CMS panel accessible only
         * through a subdomain, leave the path setting empty and enter
         * the subdomain here.
         *
         * @var null|string|string[]
         */
        'domain' => env('MADE_CMS_PANEL_DOMAIN'),

    ],

    /**
     * ### Database
     */
    'database' => [

        /**
         * ### Table prefix
         *
         * This value will be used with prefixing the generated database tables
         * from this plugin.
         *
         * @var string
         */
        'table_prefix' => env('MADE_CMS_DATABASE_TABLE_PREFIX', 'made_cms_'),

    ],

];
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Menno Tempelaar](https://github.com/mennotempelaar)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
