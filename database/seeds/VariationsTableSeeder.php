<?php

use Illuminate\Database\Seeder;
use App\Models\Variation;
use App\Models\Product;

class VariationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coffee = Product::where('slug', 'coffee')->first();
        $superCoffee = Product::where('slug', 'super-coffee')->first();
        $awesomeCoffee = Product::where('slug', 'awesome-coffee')->first();
        
        /**
         * Coffee
         */
        factory(Variation::class)->create([
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
            'type_id' => 1,
            'product_id' => $coffee->id,
        ]);

        factory(Variation::class)->create([
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
            'type_id' => 1,
            'product_id' => $coffee->id,
        ]);

        factory(Variation::class)->create([
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
            'type_id' => 1,
            'product_id' => $coffee->id,
        ]);

        factory(Variation::class)->create([
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
            'type_id' => 2,
            'product_id' => $coffee->id,
        ]);

        factory(Variation::class)->create([
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
            'type_id' => 2,
            'product_id' => $coffee->id,
        ]);

        factory(Variation::class)->create([
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
            'type_id' => 2,
            'product_id' => $coffee->id,
        ]);

        /**
         * Super Coffee
         */
        factory(Variation::class)->create([
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
            'type_id' => 1,
            'product_id' => $superCoffee->id,
        ]);

        factory(Variation::class)->create([
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
            'type_id' => 1,
            'product_id' => $superCoffee->id,
        ]);

        factory(Variation::class)->create([
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
            'type_id' => 1,
            'product_id' => $superCoffee->id,
        ]);

        factory(Variation::class)->create([
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
            'type_id' => 2,
            'product_id' => $superCoffee->id,
        ]);

        factory(Variation::class)->create([
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
            'type_id' => 2,
            'product_id' => $superCoffee->id,
        ]);

        factory(Variation::class)->create([
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
            'type_id' => 2,
            'product_id' => $superCoffee->id,
        ]);

        /**
         * Awesome Coffee
         */
        factory(Variation::class)->create([
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
            'type_id' => 1,
            'product_id' => $awesomeCoffee->id,
        ]);

        factory(Variation::class)->create([
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
            'type_id' => 1,
            'product_id' => $awesomeCoffee->id,
        ]);

        factory(Variation::class)->create([
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
            'type_id' => 1,
            'product_id' => $awesomeCoffee->id,
        ]);

        factory(Variation::class)->create([
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
            'type_id' => 2,
            'product_id' => $awesomeCoffee->id,
        ]);

        factory(Variation::class)->create([
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
            'type_id' => 2,
            'product_id' => $awesomeCoffee->id,
        ]);

        factory(Variation::class)->create([
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
            'type_id' => 2,
            'product_id' => $awesomeCoffee->id,
        ]);
    }
}
