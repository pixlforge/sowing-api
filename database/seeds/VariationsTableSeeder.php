<?php

use Illuminate\Database\Seeder;
use App\Models\Variation;

class VariationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
            'product_id' => 1,
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
            'product_id' => 1,
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
            'product_id' => 1,
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
            'product_id' => 1,
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
            'product_id' => 1,
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
            'product_id' => 1,
            'type_id' => 2,
        ]);
    }
}
