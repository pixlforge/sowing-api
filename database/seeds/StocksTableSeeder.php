<?php

use Illuminate\Database\Seeder;
use App\Models\Stock;

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
            'variation_id' => 1,
            'quantity' => 100
        ]);

        factory(Stock::class)->create([
            'variation_id' => 2,
            'quantity' => 50
        ]);

        factory(Stock::class)->create([
            'variation_id' => 3,
            'quantity' => 20
        ]);

        factory(Stock::class)->create([
            'variation_id' => 4,
            'quantity' => 100
        ]);

        factory(Stock::class)->create([
            'variation_id' => 5,
            'quantity' => 50
        ]);

        factory(Stock::class)->create([
            'variation_id' => 6,
            'quantity' => 20
        ]);
    }
}
