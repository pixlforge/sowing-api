<?php

namespace App\Cart;

use App\Models\User;
use App\Money\Money;
use App\Models\ShippingMethod;

class Cart
{
    /**
     * The user who owns this cart.
     *
     * @var User $user
     */
    protected $user;

    /**
     * Set to true when one or more of the product variations
     * quantities in the user's cart were changed.
     *
     * @var boolean
     */
    protected $changed = false;

    /**
     * The shipping method.
     *
     * @var object
     */
    protected $shippingMethod;
    
    /**
     * Cart constructor.
     *
     * @param $user
     */
    public function __construct($user)
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
     * Remove all product variations from the cart.
     *
     * @return void
     */
    public function empty()
    {
        $this->user->cart()->detach();
    }

    /**
     * Checks whether or not the cart is empty in terms of product quantity.
     *
     * @return boolean
     */
    public function isEmpty()
    {
        return $this->user->cart->sum('pivot.quantity') <= 0;
    }

    /**
     * Synchronize the cart's product variations quantities.
     *
     * @return void
     */
    public function sync()
    {
        $this->user->cart->each(function ($variation) {
            $minimumStock = $variation->minStock($variation->pivot->quantity);

            if ($minimumStock != $variation->pivot->quantity) {
                $this->changed = true;
            }

            if ($this->hasChanged()) {
                $variation->pivot->update([
                    'quantity' => $minimumStock
                ]);
            }
        });
    }

    /**
     * Determines whether the user's cart quantities have been changed.
     *
     * @return boolean
     */
    public function hasChanged()
    {
        return $this->changed;
    }

    /**
     * Returns the cart's subtotal.
     *
     * @return \App\Money\Money
     */
    public function subtotal()
    {
        $subtotal = $this->user->cart->sum(function ($variation) {
            return $variation->price->amount() * $variation->pivot->quantity;
        });

        return new Money($subtotal);
    }

    /**
     * Returns the cart's total.
     *
     * @return \App\Money\Money
     */
    public function total()
    {
        if ($this->shippingMethod) {
            return $this->subtotal()->add($this->shippingMethod->price);
        }

        return $this->subtotal();
    }

    /**
     * Sets the selected shipping method's id.
     *
     * @param integer $shippingMethodId
     * @return $this
     */
    public function withShipping($shippingMethodId)
    {
        $this->shippingMethod = ShippingMethod::find($shippingMethodId);

        return $this;
    }

    /**
     * Returns a collection of product variations.
     *
     * @return App\Models\Variation
     */
    public function variations()
    {
        return $this->user->cart;
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
