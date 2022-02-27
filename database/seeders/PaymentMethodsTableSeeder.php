<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'celien@pixlforge.ch')->first();

        PaymentMethod::factory()->states('default')->create([
            'user_id' => $user->id,
            'card_type' => 'mastercard',
            'last_four' => '4242',
            'provider_id' => 'abc'
        ]);

        PaymentMethod::factory()->create([
            'user_id' => $user->id,
            'card_type' => 'visa',
            'last_four' => '5353',
            'provider_id' => 'def'
        ]);

        PaymentMethod::factory()->create([
            'user_id' => $user->id,
            'card_type' => 'amex',
            'last_four' => '6464',
            'provider_id' => 'ghi'
        ]);
    }
}
