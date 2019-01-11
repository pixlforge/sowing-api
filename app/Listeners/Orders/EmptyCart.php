<?php

namespace App\Listeners\Orders;

use App\Cart\Cart;

class EmptyCart
{
    /**
     * The cart property
     *
     * @var App\Cart\Cart
     */
    protected $cart;
    
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle()
    {
        $this->cart->empty();
    }
}
