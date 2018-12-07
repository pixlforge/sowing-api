<?php

namespace App\Http\Controllers\Cart;

use App\Cart\Cart;
use App\Models\Variation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Cart\CartResource;
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
     * @param Request $request
     * @return App\Http\Resources\Cart\CartResource
     */
    public function index(Request $request, Cart $cart)
    {
        $request->user()->load([
            'cart.product.variations.stock',
            'cart.stock',
            'cart.type'
        ]);

        return (new CartResource($request->user()))
            ->additional([
                'meta' => $this->meta($cart)
            ]);
    }
    
    /**
     * Add product variations to the cart.
     *
     * @param CartStoreRequest $request
     * @param Cart $cart
     * @return void
     */
    public function store(CartStoreRequest $request, Cart $cart)
    {
        $cart->add($request->variations);
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

    public function meta(Cart $cart)
    {
        return [
            'is_empty' => $cart->isEmpty()
        ];
    }
}
