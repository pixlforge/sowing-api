<?php

use Illuminate\Database\Seeder;
use App\Models\Shop;
use App\Models\User;
use App\Models\Country;

class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'testuser1@example.com')->first();
        $country = Country::where('code', 'CH')->first();
        
        factory(Shop::class)->create([
            'user_id' => $user->id,
            'name' => 'Test User 1 Shop',
            'country_id' => $country->id
        ]);

        $user = User::where('email', 'celien@example.com')->first();

        factory(Shop::class)->create([
            'user_id' => $user->id,
            'name' => 'Pixlforge',
            'country_id' => $country->id
        ]);
    }
}
