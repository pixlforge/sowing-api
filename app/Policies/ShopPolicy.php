<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Shop;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShopPolicy
{
    use HandlesAuthorization;

    /**
     * User is authorized to update the shop.
     *
     * @param User $user
     * @param Shop $shop
     * @return boolean
     */
    public function update(User $user, Shop $shop)
    {
        return $user->id === $shop->user->id;
    }
}
