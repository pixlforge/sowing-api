<?php

namespace App\Payments\Stripe;

use Exception;
use Stripe\Card;
use Illuminate\Support\Str;
use App\Models\PaymentMethod;
use Stripe\Charge as BaseCharge;
use Stripe\Customer as BaseCustomer;
use App\Exceptions\PaymentFailedException;
use App\Payments\Contracts\CustomerContract;
use App\Exceptions\PaymentMethodDeletionException;
use App\Payments\Contracts\PaymentGatewayContract;

class StripeCustomer implements CustomerContract
{
    /**
     * The PaymentGateway property.
     *
     * @var PaymentGatewayContract $paymentGateway
     */
    protected $paymentGateway;

    /**
     * The customer property.
     *
     * @var BaseCustomer $customer
     */
    protected $customer;

    /**
     * StripeCustomer constructor.
     *
     * @param PaymentGatewayContract $paymentGateway
     * @param BaseCustomer $customer
     */
    public function __construct(PaymentGatewayContract $paymentGateway, BaseCustomer $customer)
    {
        $this->paymentGateway = $paymentGateway;
        $this->customer = $customer;
    }
    
    /**
     * Charge a customer.
     *
     * @param PaymentMethod $paymentMethod
     * @param integer $amount
     * @return void
     */
    public function charge(PaymentMethod $paymentMethod, $amount)
    {
        try {
            return BaseCharge::create([
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
        return $this->paymentGateway->getUser()->paymentMethods()->create([
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
     * Remove a card owned by the customer over on Stripe.
     *
     * @param string $cardId
     * @return void
     */
    public function removeCard(string $cardId)
    {
        try {
            $this->customer->deleteSource(
                $this->id(),
                $cardId
            );
        } catch (Exception $e) {
            throw new PaymentMethodDeletionException();
        }
    }

    /**
     * Get the Stripe Customer id.
     *
     * @return string
     */
    public function id()
    {
        return $this->customer->id;
    }
}
