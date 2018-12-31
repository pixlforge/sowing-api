<?php

namespace App\Providers;

use Stripe\Stripe;
use Illuminate\Support\ServiceProvider;
use App\PaymentGateways\Contracts\PaymentGateway;
use App\PaymentGateways\Stripe\StripePaymentGateway;

class StripeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PaymentGateway::class, function () {
            return new StripePaymentGateway();
        });
    }
}
