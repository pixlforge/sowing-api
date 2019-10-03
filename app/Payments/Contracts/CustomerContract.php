<?php

namespace App\Payments\Contracts;

use App\Models\PaymentMethod;

interface CustomerContract
{
    /**
     * Charge a customer.
     *
     * @param PaymentMethod $paymentMethod
     * @param int $amount
     * @return void
     */
    public function charge(PaymentMethod $paymentMethod, $amount);

    /**
     * Add a new card.
     *
     * @param string $token
     * @return void
     */
    public function addCard($token);

    /**
     * Remove a card owned by the customer over on Stripe.
     *
     * @param string $cardId
     * @return void
     */
    public function removeCard(string $cardId);

    /**
     * Get the Gateway Customer id.
     *
     * @return int
     */
    public function id();
}
