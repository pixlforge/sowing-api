<?php

use App\Models\Stock;
use Illuminate\Database\Seeder;

class StocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Stock::class)->create([
            'product_variation_id' => 1,
            'quantity' => 100
        ]);

        factory(Stock::class)->create([
            'product_variation_id' => 2,
            'quantity' => 50
        ]);

        factory(Stock::class)->create([
            'product_variation_id' => 3,
            'quantity' => 20
        ]);

        factory(Stock::class)->create([
            'product_variation_id' => 4,
            'quantity' => 100
        ]);

        factory(Stock::class)->create([
            'product_variation_id' => 5,
            'quantity' => 50
        ]);

        factory(Stock::class)->create([
            'product_variation_id' => 6,
            'quantity' => 20
        ]);
    }
}
