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
        User::factory()->create([
            'name' => 'Célien',
            'email' => 'celien@pixlforge.ch',
            'password' => 'password',
        ]);

        User::factory()->create([
            'name' => 'Raffaella',
            'email' => 'raffaella@pixlforge.ch',
            'password' => 'password',
        ]);

        User::factory()->create([
            'name' => 'Sophie',
            'email' => 'sophie@sowing.ch',
            'password' => 'password',
        ]);

        User::factory()->create([
            'name' => 'Test User 1',
            'email' => 'testuser1@example.com',
            'password' => 'password',
        ]);

        User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'testuser2@example.com',
            'password' => 'password',
        ]);

        User::factory()->create([
            'name' => 'Test User 3',
            'email' => 'testuser3@example.com',
            'password' => 'password',
        ]);
    }
}
