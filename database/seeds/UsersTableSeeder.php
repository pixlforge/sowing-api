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
        factory(User::class)->states('admin')->create([
            'name' => 'Célien',
            'email' => 'celien@pixlforge.ch',
            'password' => bcrypt('secret'),
        ]);
    }
}
