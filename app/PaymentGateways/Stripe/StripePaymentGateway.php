<?php

namespace App\PaymentGateways\Stripe;

use App\Models\User;
use App\PaymentGateways\Contracts\PaymentGateway;

class StripePaymentGateway implements PaymentGateway
{
    protected $user;
    
    /**
     * Undocumented function
     *
     * @param User $user
     * @return void
     */
    public function withUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function createCustomer()
    {
        return new StripeGatewayCustomer();
    }
}
