<?php

namespace LaravePaymentHub\Tests;

use Ajadipaul\LaravelPaymentHub\Gateways\Flutterwave;
use Ajadipaul\LaravelPaymentHub\Gateways\Paystack;
use PHPUnit\Framework\TestCase;

class PaymentGatewayTest extends TestCase
{
    protected $flutterwave;
    protected $paystack;

    protected function setUp(): void
    {
        parent::setUp();

        $this->flutterwave = new Flutterwave();
        $this->paystack = new Paystack();

        $this->flutterwave->initialize([
            'public_key' => 'test_public_key',
            'secret_key' => 'test_secret_key',
            'encryption_key' => 'test_encryption_key',
        ]);

        $this->paystack->initialize([
            'public_key' => env('PAYSTACK_PUBLIC_KEY'),
            'secret_key' => env('PAYSTACK_SECRET_KEY'),
        ]);
    }

    // public function testFlutterwaveCharge()
    // {
    //     $response = $this->flutterwave->charge([
    //         'amount' => 1000,
    //         'currency' => 'NGN',
    //         'email' => 'customer@example.com',
    //     ]);

    //     $this->assertArrayHasKey('status', $response);
    //     $this->assertEquals('success', $response['status']);
    // }

    // public function testFlutterwaveVerify()
    // {
    //     $response = $this->flutterwave->verify('test_transaction_id');

    //     $this->assertArrayHasKey('status', $response);
    //     $this->assertEquals('success', $response['status']);
    // }

    public function testPaystackCharge()
    {
        $response = $this->paystack->charge([
            'amount' => 1000,
            'currency' => 'NGN',
            'email' => 'customer@example.com',
            'callback_url' => 'localhost'
        ]);
        // print_r($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertEquals('success', $response['status']);
    }

    public function testPaystackVerify()
    {
        $response = $this->paystack->verify('d5xvl8hczo');

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals('success', $response['status']);
    }
}