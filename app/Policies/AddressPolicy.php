<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Address;
use Illuminate\Auth\Access\HandlesAuthorization;

class AddressPolicy
{
    use HandlesAuthorization;

    /**
     * User is authorized to view the address.
     *
     * @param User $user
     * @param Address $address
     * @return bool
     */
    public function show(User $user, Address $address)
    {
        return $user->is($address->user);
    }

    /**
     * User is authorized to update the address.
     *
     * @param User $user
     * @param Address $address
     * @return bool
     */
    public function update(User $user, Address $address)
    {
        return $user->is($address->user);
    }

    /**
     * User is authorized to delete the address.
     *
     * @param User $user
     * @param Address $address
     * @return bool
     */
    public function destroy(User $user, Address $address)
    {
        return $user->is($address->user);
    }
}
