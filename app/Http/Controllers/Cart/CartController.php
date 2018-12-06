<?php

namespace App\Http\Controllers\Cart;

use App\Cart\Cart;
use App\Models\Variation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
}
