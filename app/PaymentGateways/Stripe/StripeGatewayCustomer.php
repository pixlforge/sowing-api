<?php

namespace App\PaymentGateways\Stripe;

use App\Models\PaymentMethod;
use App\PaymentGateways\Contracts\PaymentGatewayCustomer;

class StripeGatewayCustomer implements PaymentGatewayCustomer
{
    /**
     * Undocumented function
     *
     * @param PaymentMethod $paymentMethod
     * @param integer $amount
     * @return void
     */
    public function charge(PaymentMethod $paymentMethod, $amount)
    {
        //
    }

    /**
     * Undocumented function
     *
     * @param string $token
     * @return void
     */
    public function addCard($token)
    {
        //
    }
}
