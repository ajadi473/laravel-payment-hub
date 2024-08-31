<?php

namespace Ajadipaul\LaravelPaymentHub\Gateways;

use Ajadipaul\LaravelPaymentHub\Contracts\LaravePaymentHubContract;
use GuzzleHttp\Client;

class Paystack implements LaravePaymentHubContract
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
            $response = $client->post('https://api.paystack.co/transaction/initialize', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->config['secret_key'],
                    'Content-Type'  => 'application/json',
                ],
                'json' => [
                    'amount' => $data['amount'] * 100,
                    'email'  => $data['email'],
                    'callback_url' => $data['callback_url'],
                ],
            ]);

            $body = json_decode($response->getBody(), true);
            if ($body['status']) {
                return [
                    'status' => 'success',
                    'authorization_url' => $body['data']['authorization_url'],
                    'reference' => $body['data']['reference'],
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
            $response = $client->get("https://api.paystack.co/transaction/verify/{$transactionId}", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->config['secret_key'],
                    'Content-Type'  => 'application/json',
                ],
            ]);

            $body = json_decode($response->getBody(), true);
            if ($body['status']) {
                return [
                    'status' => 'success',
                    'data' => $body['data'], // Contains details about the transaction
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
