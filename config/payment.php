<?php


return [
    'default' => env('PAYMENT_GATEWAY', 'flutterwave'),

    'gateways' => [
        'flutterwave' => [
            'public_key' => env('FLUTTERWAVE_PUBLIC_KEY'),
            'secret_key' => env('FLUTTERWAVE_SECRET_KEY'),
            'encryption_key' => env('FLUTTERWAVE_ENCRYPTION_KEY'),
            'payment_url' => env('FLUTTERWAVE_PAYMENT_URL', 'https://api.flutterwave.com/v3'),
        ],

        'paystack' => [
            'public_key' => env('PAYSTACK_PUBLIC_KEY'),
            'secret_key' => env('PAYSTACK_SECRET_KEY'),
            'payment_url' => env('PAYSTACK_PAYMENT_URL', 'https://api.paystack.co'),
        ],
    ],
];