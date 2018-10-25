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
        $category = Category::find(9);

        $category->products()->save(
            factory(Product::class)->create()
        );

        $category->products()->save(
            factory(Product::class)->create()
        );

        $category->products()->save(
            factory(Product::class)->create()
        );
    }
}
