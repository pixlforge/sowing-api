<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ClothingSubcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(WomensClothingSubcategoriesTableSeeder::class);
        $this->call(MensClothingSubcategoriesTableSeeder::class);
    }
}
