<?php

namespace App\Http\Controllers\Cart;

use App\Cart\Cart;
use App\Models\Variation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Cart\CartResource;
use App\Http\Requests\Cart\CartIndexRequest;
use App\Http\Requests\Cart\CartStoreRequest;
use App\Http\Requests\Cart\CartUpdateRequest;

class CartController extends Controller
{
    /**
     * CartController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Get the cart's content.
     *
     * @param CartIndexRequest $request
     * @return CartResource
     */
    public function index(CartIndexRequest $request, Cart $cart)
    {
        $cart->sync();
        
        $request->user()->load([
            'cart.product.variations.stock',
            'cart.stock',
            'cart.type'
        ]);

        return (CartResource::make($request->user()))
            ->additional([
                'meta' => $this->meta($cart, $request)
            ]);
    }
    
    /**
     * Add product variations to the cart and sync it.
     *
     * @param CartStoreRequest $request
     * @param Cart $cart
     * @return void
     */
    public function store(CartStoreRequest $request, Cart $cart)
    {
        $cart->add($request->variations);

        $cart->sync();
    }

    /**
     * Update a given product variation with the quantity provided in the request.
     *
     * @param Variation $variation
     * @param CartUpdateRequest $request
     * @param Cart $cart
     * @return void
     */
    public function update(Variation $variation, CartUpdateRequest $request, Cart $cart)
    {
        $cart->update($variation->id, $request->quantity);
    }

    /**
     * Remove a product variation from the cart.
     *
     * @param Variation $variation
     * @param Cart $cart
     * @return void
     */
    public function destroy(Variation $variation, Cart $cart)
    {
        $cart->delete($variation->id);
    }

    /**
     * Return meta information about the state of the cart.
     *
     * @param Cart $cart
     * @param Request $request
     * @return array
     */
    public function meta(Cart $cart, Request $request)
    {
        return [
            'is_empty' => $cart->isEmpty(),
            'subtotal' => [
                'detailed' => $cart->subtotal()->detailed(),
                'formatted' => $cart->subtotal()->formatted()
            ],
            'total' => [
                'detailed' => $cart->withShipping($request->shipping_method_id)->total()->detailed(),
                'formatted' => $cart->withShipping($request->shipping_method_id)->total()->formatted()
            ],
            'has_changed' => $cart->hasChanged()
        ];
    }
}
