<?php

use Illuminate\Database\Seeder;
use App\Models\Type;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Type::class)->create([
            'name' => [
                'en' => 'Whole beans',
                'fr' => 'Grains entiers',
                'de' => 'Ganze Körner',
                'it' => 'Grani interi',
            ],
        ]);

        factory(Type::class)->create([
            'name' => [
                'en' => 'Ground',
                'fr' => 'Moulu',
                'de' => 'Gemahlener',
                'it' => 'Macinato',
            ],
        ]);
    }
}
