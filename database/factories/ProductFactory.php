<?php

namespace Database\Factories;

use App\Models\Shop;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'shop_id' => Shop::factory(),
            'name' => [
                'en' => $name = $this->faker->unique()->name,
                'fr' => $name,
                'de' => $name,
                'it' => $name,
            ],
            'description' => [
                'en' => $this->faker->paragraphs(rand(2, 6), true),
                'fr' => $this->faker->paragraphs(rand(2, 6), true),
                'de' => $this->faker->paragraphs(rand(2, 6), true),
                'it' => $this->faker->paragraphs(rand(2, 6), true),
            ],
            'price' => 1000
        ];
    }
}
