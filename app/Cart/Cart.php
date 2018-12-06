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
     * Update a product variation quantity.
     *
     * @param int $variationId
     * @param int $quantity
     * @return void
     */
    public function update($variationId, $quantity)
    {
        $this->user->cart()->updateExistingPivot($variationId, [
            'quantity' => $quantity
        ]);
    }

    /**
     * Remove a product variation from the cart.
     *
     * @param int $variationId
     * @return void
     */
    public function delete($variationId)
    {
        $this->user->cart()->detach($variationId);
    }

    /**
     * Get the product variations present in the cart and format them.
     *
     * @param array $variations
     * @return array
     */
    protected function getStorePayload($variations)
    {
        return collect($variations)->keyBy('id')->map(function ($variation) {
            return [
                'quantity' => $variation['quantity'] + $this->getCurrentQuantity($variation['id'])
            ];
        })->toArray();
    }

    /**
     * Get the current quantity for a product variation present in the cart.
     *
     * @param int $variationId
     * @return void
     */
    protected function getCurrentQuantity($variationId)
    {
        if ($variation = $this->user->cart->where('id', $variationId)->first()) {
            return $variation->pivot->quantity;
        }

        return 0;
    }
}
