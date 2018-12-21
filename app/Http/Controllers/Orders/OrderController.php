<?php

namespace App\Http\Controllers\Orders;

use App\Cart\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\OrderStoreRequest;

class OrderController extends Controller
{
    /**
     * OrderController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    /**
     * Store a new order and sync the product variations contained in the cart.
     *
     * @param OrderStoreRequest $request
     * @param Cart $cart
     * @return void
     */
    public function store(OrderStoreRequest $request, Cart $cart)
    {
        if ($cart->isEmpty()) {
            return response(null, 400);
        }

        $order = $this->createOrder($request, $cart);

        $order->variations()->sync(
            $cart->variations()->forSyncing()
        );
    }
    
    /**
     * Create the order using the cart's contents.
     *
     * @param Request $request
     * @param Cart $cart
     * @return App\Models\Order
     */
    protected function createOrder(Request $request, Cart $cart)
    {
        return $request->user()->orders()->create(
            array_merge($request->only(['address_id', 'shipping_method_id']), [
                'subtotal' => $cart->subtotal()->amount()
            ])
        );
    }
}
