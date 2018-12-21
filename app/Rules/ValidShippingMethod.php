<?php

namespace App\Rules;

use App\Models\Address;
use Illuminate\Contracts\Validation\Rule;

class ValidShippingMethod implements Rule
{
    /**
     * The address id property.
     *
     * @var integer
     */
    protected $addressId;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($addressId)
    {
        $this->addressId = $addressId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!$address = $this->getAddress()) {
            return false;
        }

        return $address->country->shippingMethods->contains('id', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.rules.invalid_shipping_method_id');
    }

    /**
     * Get the address using the provided address id.
     *
     * @return App\Models\Address
     */
    protected function getAddress()
    {
        return Address::find($this->addressId);
    }
}
