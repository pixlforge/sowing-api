<?php

namespace App\Http\Controllers\Orders;

use App\Cart\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Events\Orders\OrderCreated;
use App\Http\Controllers\Controller;
use App\Http\Resources\Orders\OrderResource;
use App\Http\Requests\Orders\OrderStoreRequest;

class OrderController extends Controller
{
    /**
     * OrderController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth:api']);
        $this->middleware(['cart.sync', 'cart.empty'])->only('store');
    }

    /**
     * List all orders for a particular user.
     *
     * @param Request $request
     * @return OrderResource
     */
    public function index(Request $request)
    {
        $orders = $request->user()->orders()
            ->with([
                'variations.stock',
                'variations.type',
                'variations.product.variations.stock',
                'address.country',
                'shippingMethod'
            ])
            ->latest()
            ->paginate(10);

        return OrderResource::collection($orders);
    }

    /**
     * Store a new order and sync the product variations contained in the cart.
     *
     * @param OrderStoreRequest $request
     * @param Cart $cart
     * @return OrderResource
     */
    public function store(OrderStoreRequest $request, Cart $cart)
    {
        $order = $this->createOrder($request, $cart);

        $order->variations()->sync($cart->variations()->forSyncing());

        OrderCreated::dispatch($order);

        return OrderResource::make($order);
    }
    
    /**
     * Create the order using the cart's contents.
     *
     * @param Request $request
     * @param Cart $cart
     * @return Order
     */
    protected function createOrder(Request $request, Cart $cart): Order
    {
        return $request->user()->orders()->create(
            array_merge($request->only(['address_id', 'shipping_method_id', 'payment_method_id']), [
                'subtotal' => $cart->subtotal()->getAmount()
            ])
        );
    }
}
