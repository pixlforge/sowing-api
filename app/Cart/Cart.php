<?php

namespace App\Cart;

use App\Models\User;

class Cart
{
    protected $user;
    
    /**
     * Cart constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Add product variations to the user's cart.
     *
     * @param array $variations
     * @return void
     */
    public function add($variations)
    {
        $this->user->cart()->syncWithoutDetaching($this->getStorePayload($variations));
    }

    /**
     * Get the product variations and format them.
     *
     * @param array $variations
     * @return \Illuminate\Support\Collection
     */
    protected function getStorePayload($variations)
    {
        return collect($variations)->keyBy('id')->map(function ($variation) {
            return [
                'quantity' => $variation['quantity'] + $this->getCurrentQuantity($variation['id'])
            ];
        })->toArray();
    }

    protected function getCurrentQuantity($variationId)
    {
        if ($variation = $this->user->cart->where('id', $variationId)->first()) {
            return $variation->pivot->quantity;
        }

        return 0;
    }
}
