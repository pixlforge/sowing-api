<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::where('slug', 'coffee')->first();

        $category->products()->save(
            factory(Product::class)->create([
                'name_en' => 'Coffee',
                'name_fr' => 'Café',
                'name_de' => 'Kaffee',
                'name_it' => 'Caffè',
                'description_en' => 'Lorem ipsum dolor sit amet',
                'description_fr' => 'Lorem ipsum dolor sit amet',
                'description_de' => 'Lorem ipsum dolor sit amet',
                'description_it' => 'Lorem ipsum dolor sit amet',
                'slug' => 'coffee'
            ])
        );
    }
}
