<?php

namespace App\Http\Controllers\PaymentMethods;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PaymentGateways\Contracts\PaymentGateway;
use App\Http\Resources\PaymentMethods\PaymentMethodResource;
use App\Http\Requests\PaymentMethods\PaymentMethodStoreRequest;

class PaymentMethodController extends Controller
{
    /**
     * The paymentGateway property.
     *
     * @var PaymentGateway
     */
    public $paymentGateway;
    
    /**
     * PaymentMethodController constructor.
     *
     * @param PaymentGateway $paymentGateway
     */
    public function __construct(PaymentGateway $paymentGateway)
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
        return PaymentMethodResource::collection($request->user()->paymentMethods);
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
            ->createCustomer()
            ->addCard($request->token);

        return new PaymentMethodResource($card);
    }
}
