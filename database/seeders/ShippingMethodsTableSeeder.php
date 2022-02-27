<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\ShippingMethod;
use Illuminate\Database\Seeder;

class ShippingMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $switzerland = Country::where('code', 'CH')->first();
        $uk = Country::where('code', 'UK')->first();

        $switzerland->shippingMethods()->attach([
            factory(ShippingMethod::class)->create([
                'name' => 'PostPac Priority',
                'price' => 2000
            ])->id,
    
            factory(ShippingMethod::class)->create([
                'name' => 'PostPac Economy'
            ])->id,
    
            factory(ShippingMethod::class)->create([
                'name' => 'UPS',
                'price' => 3000
            ])->id,
    
            factory(ShippingMethod::class)->create([
                'name' => 'DPD',
                'price' => 2500
            ])->id,
    
            factory(ShippingMethod::class)->create([
                'name' => 'DHL',
                'price' => 2300
            ])->id
        ]);

        $uk->shippingMethods()->attach([
            factory(ShippingMethod::class)->create([
                'name' => 'Royal Mail',
                'price' => 1400
            ])->id
        ]);
    }
}
