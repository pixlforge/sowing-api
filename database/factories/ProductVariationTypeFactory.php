<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductVariationType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariationType>
 */
class ProductVariationTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductVariationType::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_id' => Product::factory(),
            'name' => [
                'en' => $this->faker->unique()->name,
                'fr' => $this->faker->unique()->name,
                'de' => $this->faker->unique()->name,
                'it' => $this->faker->unique()->name,
            ]
        ];
    }
}
