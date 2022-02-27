<?php

namespace Database\Seeders;

use App\Models\Shop;
use App\Models\User;
use App\Models\Country;
use Illuminate\Database\Seeder;

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
        
        Shop::factory()->create([
            'user_id' => $user->id,
            'name' => 'Test User 1 Shop',
            'country_id' => $country->id
        ]);

        $user = User::where('email', 'celien@pixlforge.ch')->first();

        Shop::factory()->create([
            'user_id' => $user->id,
            'name' => 'Pixlforge',
            'country_id' => $country->id
        ]);
    }
}
