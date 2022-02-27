<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductVariationType;

class ProductVariationTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ProductVariationType::class)->create([
            'name' => [
                'en' => 'Whole beans',
                'fr' => 'Grains entiers',
                'de' => 'Ganze Körner',
                'it' => 'Grani interi',
            ],
        ]);

        factory(ProductVariationType::class)->create([
            'name' => [
                'en' => 'Ground',
                'fr' => 'Moulu',
                'de' => 'Gemahlener',
                'it' => 'Macinato',
            ],
        ]);
    }
}
