<?php

namespace App\PaymentGateways\Stripe;

use App\Models\User;
use Stripe\Customer as StripeCustomer;
use App\PaymentGateways\Contracts\PaymentGateway;

class StripePaymentGateway implements PaymentGateway
{
    /**
     * The User property.
     *
     * @var User
     */
    protected $user;
    
    /**
     * Set the User property.
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
     * Get the User property.
     *
     * @return User
     */
    public function user()
    {
        return $this->user;
    }

    /**
     * Create or retrieve a Stripe Customer.
     *
     * @return void
     */
    public function createCustomer()
    {
        if ($this->user->hasGatewayCustomerId()) {
            return $this->getCustomer();
        }

        $customer = new StripeGatewayCustomer($this, $this->createStripeCustomer());

        $this->user->update([
            'gateway_customer_id' => $customer->id()
        ]);

        return $customer;
    }

    /**
     * Retrieve the Stripe Customer from Stripe.
     *
     * @return StripeGatewayCustomer
     */
    public function getCustomer()
    {
        return new StripeGatewayCustomer(
            $this,
            StripeCustomer::retrieve($this->user->getGatewayCustomerId())
        );
    }

    /**
     * Create a Customer object over on Stripe.
     *
     * @return StripeCustomer
     */
    protected function createStripeCustomer()
    {
        return StripeCustomer::create([
            'email' => $this->user->email
        ]);
    }
}
