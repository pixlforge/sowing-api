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
        ProductVariationType::factory()->create([
            'name' => [
                'en' => 'Whole beans',
                'fr' => 'Grains entiers',
                'de' => 'Ganze Körner',
                'it' => 'Grani interi',
            ],
        ]);

        ProductVariationType::factory()->create([
            'name' => [
                'en' => 'Ground',
                'fr' => 'Moulu',
                'de' => 'Gemahlener',
                'it' => 'Macinato',
            ],
        ]);
    }
}
