<?php

namespace Ajadipaul\LaravelPaymentHub\Gateways;

use Ajadipaul\LaravelPaymentHub\Contracts\LaravePaymentHubContract;
use GuzzleHttp\Client;

class Flutterwave implements LaravePaymentHubContract
{
    protected $config;

    public function initialize(array $config)
    {
        $this->config = $config;
    }

    public function charge(array $data)
    {
        $client = new Client();

        try {
            $response = $client->post('https://api.flutterwave.com/v3/payments', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->config['secret_key'],
                    'Content-Type'  => 'application/json',
                ],
                'json' => [
                    'tx_ref' => uniqid().time(), // Unique transaction reference
                    'amount' => $data['amount'],
                    'currency' => $data['currency'],
                    'redirect_url' => $data['callback_url'], // URL to redirect after payment
                    'customer' => [
                        'email' => $data['email'],
                        'name' => $data['name'] ?? 'Customer', // Optional name
                    ],
                    'payment_options' => 'card', // Specify multiple payment options if needed
                    // Add other necessary fields if needed
                ],
            ]);

            $body = json_decode($response->getBody(), true);
            if ($body['status'] === 'success') {
                return [
                    'status' => 'success',
                    'link' => $body['data']['link'],
                ];
            }

            return [
                'status' => 'error',
                'message' => $body['message'],
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }
    }

    public function verify(string $transactionId)
    {
        $client = new Client();

        try {
            $response = $client->get("https://api.flutterwave.com/v3/transactions/{$transactionId}/verify", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->config['secret_key'],
                    'Content-Type'  => 'application/json',
                ],
            ]);

            $body = json_decode($response->getBody(), true);
            if ($body['status'] === 'success') {
                return [
                    'status' => 'success',
                    'data' => $body['data'],
                ];
            }

            return [
                'status' => 'error',
                'message' => $body['message'],
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }
    }
}
