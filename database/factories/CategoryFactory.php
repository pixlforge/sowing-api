<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

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
                'en' => $sentences = $this->faker->sentences(2, true),
                'fr' => $sentences,
                'de' => $sentences,
                'it' => $sentences,
            ],
        ];
    }

    /**
     * Create a parent category.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function hasParent()
    {
        return $this->state(function (array $attributes) {
            return [
                'parent_id' => Category::factory(),
            ];
        });
    }
}
