<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'Célien',
            'email' => 'celien@pixlforge.ch',
            'password' => 'secret',
        ]);

        factory(User::class)->create([
            'name' => 'Raffaella',
            'email' => 'raffaella@pixlforge.ch',
            'password' => 'secret',
        ]);

        factory(User::class)->create([
            'name' => 'Sophie',
            'email' => 'sophie@sowing.ch',
            'password' => 'secret',
        ]);
    }
}
