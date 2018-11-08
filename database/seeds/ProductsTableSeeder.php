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
                'name' => [
                    'en' => $name = 'Coffee',
                    'fr' => 'Café',
                    'de' => 'Kaffee',
                    'it' => 'Caffè',
                ],
                'description' => [
                    'en' => 'Lorem ipsum dolor sit amet',
                    'fr' => 'Lorem ipsum dolor sit amet',
                    'de' => 'Lorem ipsum dolor sit amet',
                    'it' => 'Lorem ipsum dolor sit amet',
                ],
                'slug' => str_slug($name)
            ])
        );
    }
}
