<?php

namespace Ajadipaul\LaravelPaymentHub;

use Illuminate\Support\ServiceProvider;
use Ajadipaul\LaravelPaymentHub\Contracts\LaravePaymentHubContract;
use Ajadipaul\LaravelPaymentHub\Gateways\Flutterwave;
use Ajadipaul\LaravelPaymentHub\Gateways\Paystack;

class LaravelPaymentHubServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-payment-hub');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-payment-hub');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            // $this->publishes([
            //     __DIR__.'/../config/config.php' => config_path('laravel-payment-hub.php'),
            // ], 'config');

            $this->publishes([
                __DIR__ . '/../config/payment.php' => config_path('payment.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-payment-hub'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laravel-payment-hub'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-payment-hub'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/payment.php', 'payment');

        $this->app->singleton(LaravePaymentHubContract::class, function ($app) {
            $gateway = config('payment.default');

            switch($gateway) {
                case 'flutterwave':
                    return new Flutterwave();
                case 'paystack':
                    return new Paystack();
                default:
                    throw new \Exception('Gateway [{$gateway}] unsupported');
            }
        });
    }
}
