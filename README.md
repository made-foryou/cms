# CMS Package for Made in Filament

[![Latest Version on Packagist](https://img.shields.io/packagist/v/made-foryou/cms.svg?style=flat-square)](https://packagist.org/packages/made-foryou/cms)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/made-foryou/cms/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/made-foryou/cms/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/made-foryou/cms/fix-php-code-styling.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/made-foryou/cms/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/made-foryou/cms.svg?style=flat-square)](https://packagist.org/packages/made-foryou/cms)



This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require made-foryou/cms
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="cms-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="cms-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="cms-views"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$cms = new Made\Cms();
echo $cms->echoPhrase('Hello, Made!');
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
