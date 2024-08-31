<?php

namespace Ajadipaul\LaravelPaymentHub\Contracts;

interface LaravePaymentHubContract
{
    public function initialize(array $config);
    public function charge(array $data);
    public function verify(string $transactionId);
}
