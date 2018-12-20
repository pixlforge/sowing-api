<?php

use Illuminate\Database\Seeder;
use App\Models\ShippingMethod;
use App\Models\Country;

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
                'name' => 'PostPac Priority'
            ])->id,
    
            factory(ShippingMethod::class)->create([
                'name' => 'PostPac Economy'
            ])->id,
    
            factory(ShippingMethod::class)->create([
                'name' => 'UPS'
            ])->id,
    
            factory(ShippingMethod::class)->create([
                'name' => 'DPD'
            ])->id,
    
            factory(ShippingMethod::class)->create([
                'name' => 'DHL'
            ])->id
        ]);

        $uk->shippingMethods()->attach([
            factory(ShippingMethod::class)->create([
                'name' => 'Royal Mail'
            ])->id
        ]);
    }
}
