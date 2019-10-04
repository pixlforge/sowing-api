<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PaymentMethod;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentMethodPolicy
{
    use HandlesAuthorization;

    /**
     * User is allowed to view the payment method.
     *
     * @param User $user
     * @param PaymentMethod $paymentMethod
     * @return bool
     */
    public function view(User $user, PaymentMethod $paymentMethod)
    {
        return $user->is($paymentMethod->user);
    }

    /**
     * User is allowed to destroy the payment method.
     *
     * @param User $user
     * @param PaymentMethod $paymentMethod
     * @return bool
     */
    public function destroy(User $user, PaymentMethod $paymentMethod)
    {
        return $user->is($paymentMethod->user);
    }
}
