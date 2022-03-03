<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentMethod>
 */
class PaymentMethodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PaymentMethod::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'card_type' => 'Mastercard',
            'last_four' => '4242',
            'provider_id' => Str::random(10)
        ];
    }

    /**
     * Indicate that the payment method is the default one.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function default()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_default' => true
            ];
        });
    }
}
