<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Models\ProductVariation;

class ProductVariationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coffee = Product::find(1);
        $superCoffee = Product::find(2);
        $awesomeCoffee = Product::find(3);
        
        /**
         * Coffee
         */
        ProductVariation::factory()->create([
            'name' => [
                'en' => '250g',
                'fr' => '250g',
                'de' => '250g',
                'it' => '250g',
            ],
            'description' => [
                'en' => 'Lorem ipsum dolor sit amet.',
                'fr' => 'Lorem ipsum dolor sit amet.',
                'de' => 'Lorem ipsum dolor sit amet.',
                'it' => 'Lorem ipsum dolor sit amet.',
            ],
            'order' => 1,
            'product_variation_type_id' => 1,
            'product_id' => $coffee->id,
        ]);

        ProductVariation::factory()->create([
            'name' => [
                'en' => '500g',
                'fr' => '500g',
                'de' => '500g',
                'it' => '500g',
            ],
            'description' => [
                'en' => 'Lorem ipsum dolor sit amet.',
                'fr' => 'Lorem ipsum dolor sit amet.',
                'de' => 'Lorem ipsum dolor sit amet.',
                'it' => 'Lorem ipsum dolor sit amet.',
            ],
            'price' => 2000,
            'order' => 2,
            'product_variation_type_id' => 1,
            'product_id' => $coffee->id,
        ]);

        ProductVariation::factory()->create([
            'name' => [
                'en' => '1kg',
                'fr' => '1kg',
                'de' => '1kg',
                'it' => '1kg',
            ],
            'description' => [
                'en' => 'Lorem ipsum dolor sit amet.',
                'fr' => 'Lorem ipsum dolor sit amet.',
                'de' => 'Lorem ipsum dolor sit amet.',
                'it' => 'Lorem ipsum dolor sit amet.',
            ],
            'price' => 3000,
            'order' => 3,
            'product_variation_type_id' => 1,
            'product_id' => $coffee->id,
        ]);

        ProductVariation::factory()->create([
            'name' => [
                'en' => '250g',
                'fr' => '250g',
                'de' => '250g',
                'it' => '250g',
            ],
            'description' => [
                'en' => 'Lorem ipsum dolor sit amet.',
                'fr' => 'Lorem ipsum dolor sit amet.',
                'de' => 'Lorem ipsum dolor sit amet.',
                'it' => 'Lorem ipsum dolor sit amet.',
            ],
            'order' => 1,
            'product_variation_type_id' => 2,
            'product_id' => $coffee->id,
        ]);

        ProductVariation::factory()->create([
            'name' => [
                'en' => '500g',
                'fr' => '500g',
                'de' => '500g',
                'it' => '500g',
            ],
            'description' => [
                'en' => 'Lorem ipsum dolor sit amet.',
                'fr' => 'Lorem ipsum dolor sit amet.',
                'de' => 'Lorem ipsum dolor sit amet.',
                'it' => 'Lorem ipsum dolor sit amet.',
            ],
            'price' => 2000,
            'order' => 2,
            'product_variation_type_id' => 2,
            'product_id' => $coffee->id,
        ]);

        ProductVariation::factory()->create([
            'name' => [
                'en' => '1kg',
                'fr' => '1kg',
                'de' => '1kg',
                'it' => '1kg',
            ],
            'description' => [
                'en' => 'Lorem ipsum dolor sit amet.',
                'fr' => 'Lorem ipsum dolor sit amet.',
                'de' => 'Lorem ipsum dolor sit amet.',
                'it' => 'Lorem ipsum dolor sit amet.',
            ],
            'price' => 3000,
            'order' => 3,
            'product_variation_type_id' => 2,
            'product_id' => $coffee->id,
        ]);

        /**
         * Super Coffee
         */
        ProductVariation::factory()->create([
            'name' => [
                'en' => '250g',
                'fr' => '250g',
                'de' => '250g',
                'it' => '250g',
            ],
            'description' => [
                'en' => 'Lorem ipsum dolor sit amet.',
                'fr' => 'Lorem ipsum dolor sit amet.',
                'de' => 'Lorem ipsum dolor sit amet.',
                'it' => 'Lorem ipsum dolor sit amet.',
            ],
            'order' => 1,
            'product_variation_type_id' => 1,
            'product_id' => $superCoffee->id,
        ]);

        ProductVariation::factory()->create([
            'name' => [
                'en' => '500g',
                'fr' => '500g',
                'de' => '500g',
                'it' => '500g',
            ],
            'description' => [
                'en' => 'Lorem ipsum dolor sit amet.',
                'fr' => 'Lorem ipsum dolor sit amet.',
                'de' => 'Lorem ipsum dolor sit amet.',
                'it' => 'Lorem ipsum dolor sit amet.',
            ],
            'price' => 2000,
            'order' => 2,
            'product_variation_type_id' => 1,
            'product_id' => $superCoffee->id,
        ]);

        ProductVariation::factory()->create([
            'name' => [
                'en' => '1kg',
                'fr' => '1kg',
                'de' => '1kg',
                'it' => '1kg',
            ],
            'description' => [
                'en' => 'Lorem ipsum dolor sit amet.',
                'fr' => 'Lorem ipsum dolor sit amet.',
                'de' => 'Lorem ipsum dolor sit amet.',
                'it' => 'Lorem ipsum dolor sit amet.',
            ],
            'price' => 3000,
            'order' => 3,
            'product_variation_type_id' => 1,
            'product_id' => $superCoffee->id,
        ]);

        ProductVariation::factory()->create([
            'name' => [
                'en' => '250g',
                'fr' => '250g',
                'de' => '250g',
                'it' => '250g',
            ],
            'description' => [
                'en' => 'Lorem ipsum dolor sit amet.',
                'fr' => 'Lorem ipsum dolor sit amet.',
                'de' => 'Lorem ipsum dolor sit amet.',
                'it' => 'Lorem ipsum dolor sit amet.',
            ],
            'order' => 1,
            'product_variation_type_id' => 2,
            'product_id' => $superCoffee->id,
        ]);

        ProductVariation::factory()->create([
            'name' => [
                'en' => '500g',
                'fr' => '500g',
                'de' => '500g',
                'it' => '500g',
            ],
            'description' => [
                'en' => 'Lorem ipsum dolor sit amet.',
                'fr' => 'Lorem ipsum dolor sit amet.',
                'de' => 'Lorem ipsum dolor sit amet.',
                'it' => 'Lorem ipsum dolor sit amet.',
            ],
            'price' => 2000,
            'order' => 2,
            'product_variation_type_id' => 2,
            'product_id' => $superCoffee->id,
        ]);

        ProductVariation::factory()->create([
            'name' => [
                'en' => '1kg',
                'fr' => '1kg',
                'de' => '1kg',
                'it' => '1kg',
            ],
            'description' => [
                'en' => 'Lorem ipsum dolor sit amet.',
                'fr' => 'Lorem ipsum dolor sit amet.',
                'de' => 'Lorem ipsum dolor sit amet.',
                'it' => 'Lorem ipsum dolor sit amet.',
            ],
            'price' => 3000,
            'order' => 3,
            'product_variation_type_id' => 2,
            'product_id' => $superCoffee->id,
        ]);

        /**
         * Awesome Coffee
         */
        ProductVariation::factory()->create([
            'name' => [
                'en' => '250g',
                'fr' => '250g',
                'de' => '250g',
                'it' => '250g',
            ],
            'description' => [
                'en' => 'Lorem ipsum dolor sit amet.',
                'fr' => 'Lorem ipsum dolor sit amet.',
                'de' => 'Lorem ipsum dolor sit amet.',
                'it' => 'Lorem ipsum dolor sit amet.',
            ],
            'order' => 1,
            'product_variation_type_id' => 1,
            'product_id' => $awesomeCoffee->id,
        ]);

        ProductVariation::factory()->create([
            'name' => [
                'en' => '500g',
                'fr' => '500g',
                'de' => '500g',
                'it' => '500g',
            ],
            'description' => [
                'en' => 'Lorem ipsum dolor sit amet.',
                'fr' => 'Lorem ipsum dolor sit amet.',
                'de' => 'Lorem ipsum dolor sit amet.',
                'it' => 'Lorem ipsum dolor sit amet.',
            ],
            'price' => 2000,
            'order' => 2,
            'product_variation_type_id' => 1,
            'product_id' => $awesomeCoffee->id,
        ]);

        ProductVariation::factory()->create([
            'name' => [
                'en' => '1kg',
                'fr' => '1kg',
                'de' => '1kg',
                'it' => '1kg',
            ],
            'description' => [
                'en' => 'Lorem ipsum dolor sit amet.',
                'fr' => 'Lorem ipsum dolor sit amet.',
                'de' => 'Lorem ipsum dolor sit amet.',
                'it' => 'Lorem ipsum dolor sit amet.',
            ],
            'price' => 3000,
            'order' => 3,
            'product_variation_type_id' => 1,
            'product_id' => $awesomeCoffee->id,
        ]);

        ProductVariation::factory()->create([
            'name' => [
                'en' => '250g',
                'fr' => '250g',
                'de' => '250g',
                'it' => '250g',
            ],
            'description' => [
                'en' => 'Lorem ipsum dolor sit amet.',
                'fr' => 'Lorem ipsum dolor sit amet.',
                'de' => 'Lorem ipsum dolor sit amet.',
                'it' => 'Lorem ipsum dolor sit amet.',
            ],
            'order' => 1,
            'product_variation_type_id' => 2,
            'product_id' => $awesomeCoffee->id,
        ]);

        ProductVariation::factory()->create([
            'name' => [
                'en' => '500g',
                'fr' => '500g',
                'de' => '500g',
                'it' => '500g',
            ],
            'description' => [
                'en' => 'Lorem ipsum dolor sit amet.',
                'fr' => 'Lorem ipsum dolor sit amet.',
                'de' => 'Lorem ipsum dolor sit amet.',
                'it' => 'Lorem ipsum dolor sit amet.',
            ],
            'price' => 2000,
            'order' => 2,
            'product_variation_type_id' => 2,
            'product_id' => $awesomeCoffee->id,
        ]);

        ProductVariation::factory()->create([
            'name' => [
                'en' => '1kg',
                'fr' => '1kg',
                'de' => '1kg',
                'it' => '1kg',
            ],
            'description' => [
                'en' => 'Lorem ipsum dolor sit amet.',
                'fr' => 'Lorem ipsum dolor sit amet.',
                'de' => 'Lorem ipsum dolor sit amet.',
                'it' => 'Lorem ipsum dolor sit amet.',
            ],
            'price' => 3000,
            'order' => 3,
            'product_variation_type_id' => 2,
            'product_id' => $awesomeCoffee->id,
        ]);
    }
}
