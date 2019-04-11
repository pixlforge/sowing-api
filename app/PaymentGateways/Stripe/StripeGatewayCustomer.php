<?php

namespace App\PaymentGateways\Stripe;

use Exception;
use Stripe\Card;
use Illuminate\Support\Str;
use App\Models\PaymentMethod;
use Stripe\Charge as StripeCharge;
use Stripe\Customer as StripeCustomer;
use App\Exceptions\PaymentFailedException;
use App\PaymentGateways\Contracts\PaymentGateway;
use App\PaymentGateways\Contracts\PaymentGatewayCustomer;

class StripeGatewayCustomer implements PaymentGatewayCustomer
{
    /**
     * The PaymentGateway property.
     *
     * @var PaymentGateway
     */
    protected $gateway;

    /**
     * The StripeCustomer property.
     *
     * @var StripeCustomer
     */
    protected $customer;

    /**
     * StripeGatewayCustomer constructor.
     *
     * @param PaymentGateway $gateway
     * @param StripeCustomer $customer
     */
    public function __construct(PaymentGateway $gateway, StripeCustomer $customer)
    {
        $this->gateway = $gateway;

        $this->customer = $customer;
    }
    
    /**
     * Undocumented function
     *
     * @param PaymentMethod $paymentMethod
     * @param integer $amount
     * @return void
     */
    public function charge(PaymentMethod $paymentMethod, $amount)
    {
        try {
            return StripeCharge::create([
                'amount' => $amount,
                'currency' => 'chf',
                'customer' => $this->customer->id,
                'source' => $paymentMethod->provider_id,
            ]);
        } catch (Exception $e) {
            throw new PaymentFailedException();
        }
    }

    /**
     * Add a card on Stripe and store it as a new payment method.
     *
     * @param string $token
     * @return void
     */
    public function addCard($token)
    {
        $card = $this->customer->sources->create([
            'source' => $token
        ]);

        $this->setCardAsDefault($card);

        return $this->createPaymentMethodFromCard($card);
    }

    /**
     * Store a new payment method using the card returned from Stripe
     * and set it as default.
     *
     * @param Card $card
     * @return void
     */
    public function createPaymentMethodFromCard(Card $card)
    {
        return $this->gateway->user()->paymentMethods()->create([
            'card_type' => $card->brand,
            'card_type_slug' => Str::slug($card->brand),
            'last_four' => $card->last4,
            'provider_id' => $card->id,
            'is_default' => true
        ]);
    }

    /**
     * Set a card as a customer's default source on Stripe.
     *
     * @param Card $card
     * @return void
     */
    public function setCardAsDefault(Card $card)
    {
        $this->customer->default_source = $card->id;
        $this->customer->save();
    }

    /**
     * Get the Stripe Customer id.
     *
     * @return integer
     */
    public function id()
    {
        return $this->customer->id;
    }
}
