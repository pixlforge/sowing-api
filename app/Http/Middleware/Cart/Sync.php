<?php

namespace App\Http\Middleware\Cart;

use Closure;
use App\Cart\Cart;

class Sync
{
    /**
     * The cart property.
     *
     * @var Cart
     */
    protected $cart;

    /**
     * Sync middleware constructor.
     *
     * @param Cart $cart
     */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->cart->sync();

        if ($this->cart->hasChanged()) {
            return response(['message' => __('validation.rules.cart_quantities_changed')], 409);
        }
        
        return $next($request);
    }
}
