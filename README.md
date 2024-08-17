# Content management system plugin

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

Next we have to install the plugin and publish it's files to the project.

```bash
php artisan made-cms:install
```

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

## Create the user

To create a cms user which can be used as an administrator / superuser account you run the following:

```bash
php artisan made:user
```

This command will ask you some questions which you have to answer to create the user.

After that you are ready to log in into the CMS panel on the selected path (default: `/made`).


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
