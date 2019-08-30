<?php

namespace App\Observers;

use App\Models\Address;

class AddressObserver
{
    /**
     * Handle the address "creating" event.
     *
     * @param  \App\Models\Address  $address
     * @return void
     */
    public function creating(Address $address): void
    {
        if ($address->isDefault()) {
            $address->user->addresses()->update([
                'is_default' => false
            ]);
        }
    }

    /**
     * Handle the address "updating" event.
     *
     * @param  \App\Models\Address  $address
     * @return void
     */
    public function updating(Address $address): void
    {
        if ($address->isDefault()) {
            $address->user->addresses()->update([
                'is_default' => false
            ]);
        }
    }
}
