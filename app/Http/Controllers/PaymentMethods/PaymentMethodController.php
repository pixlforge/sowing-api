<?php

namespace App\Http\Controllers\PaymentMethods;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Controllers\Controller;
use App\Payments\Contracts\PaymentGatewayContract;
use App\Http\Resources\PaymentMethods\PaymentMethodResource;
use App\Http\Requests\PaymentMethods\PaymentMethodStoreRequest;

class PaymentMethodController extends Controller
{
    /**
     * The paymentGateway property.
     *
     * @var PaymentGatewayContract
     */
    public $paymentGateway;
    
    /**
     * PaymentMethodController constructor.
     *
     * @param PaymentGatewayContract $paymentGateway
     */
    public function __construct(PaymentGatewayContract $paymentGateway)
    {
        $this->middleware(['auth:api']);

        $this->paymentGateway = $paymentGateway;
    }

    /**
     * Get the authenticated user's payment methods.
     *
     * @param Request $request
     * @return PaymentMethodResource
     */
    public function index(Request $request)
    {
        return PaymentMethodResource::collection($request->user()->paymentMethods()->latest()->get());
    }

    /**
     * Show a specific payment method.
     *
     * @param PaymentMethod $paymentMethod
     * @return PaymentMethodResource
     */
    public function show(PaymentMethod $paymentMethod)
    {
        $this->authorize('view', $paymentMethod);
        
        return PaymentMethodResource::make($paymentMethod);
    }

    /**
     * Store a new payment resource.
     *
     * @param PaymentMethodStoreRequest $request
     * @return PaymentMethodResource
     */
    public function store(PaymentMethodStoreRequest $request)
    {
        $card = $this->paymentGateway->withUser($request->user())
            ->getOrCreateCustomer()
            ->addCard($request->token);

        return PaymentMethodResource::make($card);
    }

    /**
     * Update an existing payment method to set it as default.
     *
     * @param PaymentMethod $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentMethod $paymentMethod)
    {
        $this->authorize('update', $paymentMethod);

        $paymentMethod->update([
            'is_default' => true
        ]);

        return response(null, 204);
    }

    /**
     * Delete a payment method.
     *
     * @param Request $request
     * @param PaymentMethod $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PaymentMethod $paymentMethod)
    {
        $this->authorize('destroy', $paymentMethod);

        $this->paymentGateway->withUser($request->user())
            ->getOrCreateCustomer()
            ->removeCard($paymentMethod->provider_id);
        
        $paymentMethod->delete();

        return response(null, 204);
    }
}
