<?php

namespace App\Payments\Contracts;

use App\Models\User;
use App\Payments\Stripe\StripeCustomer;

interface PaymentGatewayContract
{
    /**
     * Inject a User in behalf of which to operate.
     *
     * @param User $user
     * @return void
     */
    public function withUser(User $user);

    /**
     * Get the user property.
     *
     * @return User
     */
    public function getUser();

    /**
     * Get or create a new Customer resource.
     *
     * @return StripeCustomer
     */
    public function getOrCreateCustomer();
}
