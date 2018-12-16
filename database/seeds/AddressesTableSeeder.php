<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Address;
use App\Models\Country;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('name', 'Célien')->first();
        $country = Country::where('code', 'CH')->first();

        factory(Address::class)->create([
            'user_id' => $user->id,
            'first_name' => 'Célien',
            'last_name' => 'Boillat',
            'company_name' => 'Pixlforge',
            'address_line_1' => 'Le Borbet 23',
            'address_line_2' => 'App 19',
            'postal_code' => '2950',
            'city' => 'Courgenay',
            'country_id' => $country->id,
        ]);
    }
}
