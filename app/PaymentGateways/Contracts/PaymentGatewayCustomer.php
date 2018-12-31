<?php

namespace App\PaymentGateways\Contracts;

use App\Models\PaymentMethod;

interface PaymentGatewayCustomer
{
    /**
     * Undocumented function
     *
     * @param PaymentMethod $paymentMethod
     * @param integer $amount
     * @return void
     */
    public function charge(PaymentMethod $paymentMethod, $amount);

    /**
     * Undocumented function
     *
     * @param string $token
     * @return void
     */
    public function addCard($token);
}
