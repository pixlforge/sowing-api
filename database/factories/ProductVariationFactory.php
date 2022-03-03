<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\ProductVariationType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariation>
 */
class ProductVariationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductVariation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => [
                'en' => $name = $this->faker->unique()->name,
                'fr' => $name,
                'de' => $name,
                'it' => $name,
            ],
            'description' => [
                'en' => $this->faker->sentence,
                'fr' => $this->faker->sentence,
                'de' => $this->faker->sentence,
                'it' => $this->faker->sentence,
            ],
            'price' => null,
            'order' => null,
            'product_variation_type_id' => ProductVariationType::factory(),
            'product_id' => Product::factory(),
        ];
    }
}
