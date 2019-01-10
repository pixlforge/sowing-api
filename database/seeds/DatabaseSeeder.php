<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

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
        $this->call(WomensClothingSubcategoriesTableSeeder::class);
        $this->call(MensClothingSubcategoriesTableSeeder::class);
        $this->call(HomeFurnishingsSubcategoriesTableSeeder::class);
        $this->call(StationerySubcategoriesTableSeeder::class);
        $this->call(ToysSubcategoriesTableSeeder::class);
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

        /**
         * Development
         */
        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Coffee',
                'fr' => 'Café',
                'de' => 'Kaffee',
                'it' => 'Caffè',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => Category::whereSlug('local-products')->first()->id,
        ]);

        $this->call(ProductsTableSeeder::class);
        $this->call(TypesTableSeeder::class);
        $this->call(VariationsTableSeeder::class);
        $this->call(StocksTableSeeder::class);
        $this->call(AddressesTableSeeder::class);
        // $this->call(PaymentMethodsTableSeeder::class);
    }
}
