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
            'product_id' => 1,
            'name_en' => '250g',
            'name_fr' => '250g',
            'name_de' => '250g',
            'name_it' => '250g',
            'description_en' => 'Lorem ipsum dolor sit amet.',
            'description_fr' => 'Lorem ipsum dolor sit amet.',
            'description_de' => 'Lorem ipsum dolor sit amet.',
            'description_it' => 'Lorem ipsum dolor sit amet.',
            'type_id' => 1,
            'order' => 1
        ]);

        factory(Variation::class)->create([
            'product_id' => 1,
            'name_en' => '500g',
            'name_fr' => '500g',
            'name_de' => '500g',
            'name_it' => '500g',
            'description_en' => 'Lorem ipsum dolor sit amet.',
            'description_fr' => 'Lorem ipsum dolor sit amet.',
            'description_de' => 'Lorem ipsum dolor sit amet.',
            'description_it' => 'Lorem ipsum dolor sit amet.',
            'type_id' => 1,
            'price' => 2000,
            'order' => 2
        ]);

        factory(Variation::class)->create([
            'product_id' => 1,
            'name_en' => '1kg',
            'name_fr' => '1kg',
            'name_de' => '1kg',
            'name_it' => '1kg',
            'description_en' => 'Lorem ipsum dolor sit amet.',
            'description_fr' => 'Lorem ipsum dolor sit amet.',
            'description_de' => 'Lorem ipsum dolor sit amet.',
            'description_it' => 'Lorem ipsum dolor sit amet.',
            'type_id' => 1,
            'price' => 3000,
            'order' => 3
        ]);

        factory(Variation::class)->create([
            'product_id' => 1,
            'name_en' => '250g',
            'name_fr' => '250g',
            'name_de' => '250g',
            'name_it' => '250g',
            'description_en' => 'Lorem ipsum dolor sit amet.',
            'description_fr' => 'Lorem ipsum dolor sit amet.',
            'description_de' => 'Lorem ipsum dolor sit amet.',
            'description_it' => 'Lorem ipsum dolor sit amet.',
            'type_id' => 2,
            'order' => 1
        ]);

        factory(Variation::class)->create([
            'product_id' => 1,
            'name_en' => '500g',
            'name_fr' => '500g',
            'name_de' => '500g',
            'name_it' => '500g',
            'description_en' => 'Lorem ipsum dolor sit amet.',
            'description_fr' => 'Lorem ipsum dolor sit amet.',
            'description_de' => 'Lorem ipsum dolor sit amet.',
            'description_it' => 'Lorem ipsum dolor sit amet.',
            'type_id' => 2,
            'price' => 2000,
            'order' => 2
        ]);

        factory(Variation::class)->create([
            'product_id' => 1,
            'name_en' => '1kg',
            'name_fr' => '1kg',
            'name_de' => '1kg',
            'name_it' => '1kg',
            'description_en' => 'Lorem ipsum dolor sit amet.',
            'description_fr' => 'Lorem ipsum dolor sit amet.',
            'description_de' => 'Lorem ipsum dolor sit amet.',
            'description_it' => 'Lorem ipsum dolor sit amet.',
            'type_id' => 2,
            'price' => 3000,
            'order' => 3
        ]);
    }
}
