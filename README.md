# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ajadipaul/laravel-payment-hub.svg?style=flat-square)](https://packagist.org/packages/ajadipaul/laravel-payment-hub)
[![Total Downloads](https://img.shields.io/packagist/dt/ajadipaul/laravel-payment-hub.svg?style=flat-square)](https://packagist.org/packages/ajadipaul/laravel-payment-hub)
![GitHub Actions](https://github.com/ajadipaul/laravel-payment-hub/actions/workflows/main.yml/badge.svg)

A comprehensive and versatile package designed to integrate multiple payment gateways into your Laravel application. This package supports a wide array of popular payment options. With Laravel Payment Hub, you can seamlessly handle payments, ensuring a smooth and unified experience for both developers and users. The package offers a standardized interface for all supported gateways, simplifying the process of switching between different payment providers without altering your codebase significantly. Enhance your Laravel application's payment capabilities with ease and flexibility using Laravel Payment Hub.

## Installation

You can install the package via composer:

```bash
composer require ajadipaul/laravel-payment-hub
```

## Usage

```php
API keys to the .env file

PAYSTACK_PUBLIC_KEY=your_paystack_public_key
PAYSTACK_SECRET_KEY=your_paystack_secret_key
FLUTTERWAVE_PUBLIC_KEY=your_flutterwave_public_key
FLUTTERWAVE_SECRET_KEY=your_flutterwave_secret_key

```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email ajadi.ololade@gmail.com instead of using the issue tracker.

## Credits

-   [Ajadi Paul](https://github.com/ajadipaul)
-   [All Contributors](../../contributors)

## License

The GNU AGPLv. Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
