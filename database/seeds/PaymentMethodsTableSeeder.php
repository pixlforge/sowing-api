<?php

use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;
use App\Models\User;

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

        factory(PaymentMethod::class)->states('default')->create([
            'user_id' => $user->id,
            'card_type' => 'mastercard',
            'last_four' => '4242',
            'provider_id' => 'abc'
        ]);

        factory(PaymentMethod::class)->create([
            'user_id' => $user->id,
            'card_type' => 'visa',
            'last_four' => '5353',
            'provider_id' => 'def'
        ]);

        factory(PaymentMethod::class)->create([
            'user_id' => $user->id,
            'card_type' => 'amex',
            'last_four' => '6464',
            'provider_id' => 'ghi'
        ]);
    }
}
