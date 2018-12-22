<?php

namespace App\Http\Middleware\Cart;

use Closure;
use App\Cart\Cart;

class IsEmpty
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
        if ($this->cart->isEmpty()) {
            return response(['message' => __('validation.rules.cart_is_empty')], 400);
        }
        
        return $next($request);
    }
}
