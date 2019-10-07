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

    /**
     * Handle the payment method "updating" event.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return void
     */
    public function updating(PaymentMethod $paymentMethod)
    {
        if ($paymentMethod->isDefault()) {
            $paymentMethod->user->paymentMethods()->update([
                'is_default' => false
            ]);
        }
    }

    /**
     * Handle the payment method "deleted" event.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return void
     */
    public function deleted(PaymentMethod $paymentMethod)
    {
        if (!$paymentMethod->isDefault()) {
            return;
        }

        $paymentMethod->update([
            'is_default' => false
        ]);

        $paymentMethods = $paymentMethod->user->paymentMethods()->get();

        if (!$paymentMethods->count()) {
            return;
        }

        $paymentMethods->first()->update([
            'is_default' => true
        ]);
    }
}
