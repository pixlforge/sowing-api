<?php

namespace App\PaymentGateways\Contracts;

use App\Models\User;

interface PaymentGateway
{
    /**
     * Undocumented function
     *
     * @param User $user
     * @return void
     */
    public function withUser(User $user);

    /**
     * Undocumented function
     *
     * @return void
     */
    public function createCustomer();
}
