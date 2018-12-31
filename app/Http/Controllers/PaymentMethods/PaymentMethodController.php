<?php

namespace App\Http\Controllers\PaymentMethods;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentMethods\PaymentMethodResource;
use App\PaymentGateways\Contracts\PaymentGateway;

class PaymentMethodController extends Controller
{
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

    public function store(Request $request)
    {
        $card = $this->paymentGateway->withUser($request->user())
            ->createCustomer()
            ->addCard($request->token);

        dd($card);
    }
}
