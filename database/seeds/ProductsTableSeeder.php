<?php

use App\Models\Shop;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
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
            factory(Product::class)->create([
                'shop_id' => $shop->id,
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
                'slug' => Str::slug($name)
            ])
        );

        $category->products()->save(
            factory(Product::class)->create([
                'shop_id' => $shop->id,
                'name' => [
                    'en' => $name = 'Super coffee',
                    'fr' => 'Super Café',
                    'de' => 'Super Kaffee',
                    'it' => 'Super Caffè',
                ],
                'description' => [
                    'en' => 'Lorem ipsum dolor sit amet',
                    'fr' => 'Lorem ipsum dolor sit amet',
                    'de' => 'Lorem ipsum dolor sit amet',
                    'it' => 'Lorem ipsum dolor sit amet',
                ],
                'slug' => Str::slug($name),
                'price' => 1500
            ])
        );

        $category->products()->save(
            factory(Product::class)->create([
                'shop_id' => $shop->id,
                'name' => [
                    'en' => $name = 'Awesome coffee',
                    'fr' => 'Café impressionnant',
                    'de' => 'Genial Kaffee',
                    'it' => 'Caffè eccezionale',
                ],
                'description' => [
                    'en' => 'Lorem ipsum dolor sit amet',
                    'fr' => 'Lorem ipsum dolor sit amet',
                    'de' => 'Lorem ipsum dolor sit amet',
                    'it' => 'Lorem ipsum dolor sit amet',
                ],
                'slug' => Str::slug($name),
                'price' => 2700
            ])
        );
    }
}
