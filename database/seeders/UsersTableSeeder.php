<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
            'password' => 'password',
        ]);

        factory(User::class)->create([
            'name' => 'Raffaella',
            'email' => 'raffaella@pixlforge.ch',
            'password' => 'password',
        ]);

        factory(User::class)->create([
            'name' => 'Sophie',
            'email' => 'sophie@sowing.ch',
            'password' => 'password',
        ]);

        factory(User::class)->create([
            'name' => 'Test User 1',
            'email' => 'testuser1@example.com',
            'password' => 'password',
        ]);

        factory(User::class)->create([
            'name' => 'Test User 2',
            'email' => 'testuser2@example.com',
            'password' => 'password',
        ]);

        factory(User::class)->create([
            'name' => 'Test User 3',
            'email' => 'testuser3@example.com',
            'password' => 'password',
        ]);
    }
}
