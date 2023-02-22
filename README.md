# Laravel Pterodactyl

[![Latest Version on Packagist](https://img.shields.io/packagist/v/pulsar/laravel-pterodactyl.svg?style=flat-square)](https://packagist.org/packages/pulsar/laravel-pterodactyl)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/pulsar/laravel-pterodactyl/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/pulsar/laravel-pterodactyl/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/pulsar/laravel-pterodactyl/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/pulsar/laravel-pterodactyl/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/pulsar/laravel-pterodactyl.svg?style=flat-square)](https://packagist.org/packages/pulsar/laravel-pterodactyl)

A mininal wrapper for laravel configuration and management of HCGCloud's pterodactyl sdk.

## Support us

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require pulsar/laravel-pterodactyl
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-pterodactyl-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-pterodactyl-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-pterodactyl-views"
```

## Usage

```php
$pterodactyl = new Pulsar\Pterodactyl();
echo $pterodactyl->echoPhrase('Hello, Pulsar!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [JoshPiper](https://github.com/Pulsar-Dev)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
