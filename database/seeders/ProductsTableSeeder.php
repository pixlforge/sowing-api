<?php

namespace Database\Seeders;

use App\Models\Shop;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

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
        $shop = Shop::first();

        $category->products()->save(
            Product::factory()->create([
                'shop_id' => $shop->id,
                'name' => [
                    'en' => $name = 'Coffee',
                    'fr' => 'Café',
                    'de' => 'Kaffee',
                    'it' => 'Caffè',
                ],
            ])
        );

        $category->products()->save(
            Product::factory()->create([
                'shop_id' => $shop->id,
                'name' => [
                    'en' => $name = 'Super coffee',
                    'fr' => 'Super Café',
                    'de' => 'Super Kaffee',
                    'it' => 'Super Caffè',
                ],
                'price' => 1500
            ])
        );

        $category->products()->save(
            Product::factory()->create([
                'shop_id' => $shop->id,
                'name' => [
                    'en' => $name = 'Awesome coffee',
                    'fr' => 'Café impressionnant',
                    'de' => 'Genial Kaffee',
                    'it' => 'Caffè eccezionale',
                ],
                'price' => 2700
            ])
        );
    }
}
