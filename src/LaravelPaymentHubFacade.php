<?php

namespace Ajadipaul\LaravelPaymentHub;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ajadipaul\LaravelPaymentHub\Skeleton\SkeletonClass
 */
class LaravelPaymentHubFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-payment-hub';
    }
}
