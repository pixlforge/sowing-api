<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Users
         */
        $this->call(UsersTableSeeder::class);

        /**
         * Categories
         */
        $this->call(CategoriesTableSeeder::class);
        $this->call(JewelrySubcategoriesTableSeeder::class);
        $this->call(ClothingSubcategoriesTableSeeder::class);
        $this->call(HomeFurnishingsSubcategoriesTableSeeder::class);
        $this->call(StationerySubcategoriesTableSeeder::class);
        $this->call(ChildrenSubcategoriesTableSeeder::class);
        $this->call(ArtSubcategoriesTableSeeder::class);
        $this->call(LocalProductsSubcategoriesTableSeeder::class);
        $this->call(BeautyWellnessSubcategoriesTableSeeder::class);

        /**
         * Countries
         */
        $this->call(CountriesTableSeeder::class);

        /**
         * Shipping methods
         */
        $this->call(ShippingMethodsTableSeeder::class);

        // Remove before deploying to production.
        $this->callDevelopmentOnlySeeders();
    }

    public function callDevelopmentOnlySeeders()
    {
        // Category::factory()->create([
        //     'name' => $name = [
        //         'en' => 'Coffee',
        //         'fr' => 'Café',
        //         'de' => 'Kaffee',
        //         'it' => 'Caffè',
        //     ],
        //     'slug' => Str::slug($name['en']),
        //     'parent_id' => Category::whereSlug('local-products')->first()->id,
        // ]);

        $this->call(ShopsTableSeeder::class);
        // $this->call(ProductsTableSeeder::class);
        // $this->call(ProductVariationTypesTableSeeder::class);
        // $this->call(ProductVariationsTableSeeder::class);
        // $this->call(StocksTableSeeder::class);
        $this->call(AddressesTableSeeder::class);
        // $this->call(PaymentMethodsTableSeeder::class);
    }
}
