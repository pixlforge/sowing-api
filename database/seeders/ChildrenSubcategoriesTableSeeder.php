<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ChildrenSubcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BabiesChildrenSubcategoriesTableSeeder::class);
        $this->call(BoysChildrenSubcategoriesTableSeeder::class);
        $this->call(GirlsChildrenSubcategoriesTableSeeder::class);
    }
}
