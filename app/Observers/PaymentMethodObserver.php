<?php

namespace App\Observers;

use App\Models\PaymentMethod;

class PaymentMethodObserver
{
    /**
     * Handle the payment method "creating" event.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return void
     */
    public function creating(PaymentMethod $paymentMethod)
    {
        if ($paymentMethod->isDefault()) {
            $paymentMethod->user->paymentMethods()->update([
                'is_default' => false
            ]);
        }
    }
}
