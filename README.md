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
//  API keys to the .env file

PAYSTACK_PUBLIC_KEY=your_paystack_public_key
PAYSTACK_SECRET_KEY=your_paystack_secret_key
FLUTTERWAVE_PUBLIC_KEY=your_flutterwave_public_key
FLUTTERWAVE_SECRET_KEY=your_flutterwave_secret_key

// Publish the configuration file to your application
php artisan vendor:publish --provider="Ajadipaul\LaravelPaymentHub\LaravelPaymentHubServiceProvider"

// Application Code Usage

class PaymentController extends Controller
{
    protected $paystack;
    protected $flutterwave;

    public function __construct()
    {
        $paystackConfig = config('paymenthub.paystack');
        $flutterwaveConfig = config('paymenthub.flutterwave');

        $this->paystack = new PaystackService();
        $this->paystack->initialize($paystackConfig);

        $this->flutterwave = new FlutterwaveService();
        $this->flutterwave->initialize($flutterwaveConfig);
    }

    public function chargeWithPaystack()
    {
        $data = [
            'amount' => 5000, // Amount in Naira
            'email' => 'user@example.com',
            'callback_url' => route('payment.callback'),
        ];

        $response = $this->paystack->charge($data);

        if ($response['status'] === 'success') {
            return redirect($response['authorization_url']);
        }

        return redirect()->back()->withErrors($response['message']);
    }

    public function chargeWithFlutterwave()
    {
        $data = [
            'amount' => 5000, // Amount in Naira
            'currency' => 'NGN',
            'email' => 'user@example.com',
            'callback_url' => route('payment.callback'),
        ];

        $response = $this->flutterwave->charge($data);

        if ($response['status'] === 'success') {
            return redirect($response['link']);
        }

        return redirect()->back()->withErrors($response['message']);
    }

    public function verifyTransaction($transactionId)
    {
        $response = $this->paystack->verify($transactionId);

        if ($response['status'] === 'success') {
            // Handle successful verification, e.g., updating order status
        } else {
            // Handle verification failure
        }
    }
}

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
