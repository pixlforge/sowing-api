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
            'name_en' => 'Whole beans',
            'name_fr' => 'Grains entiers',
            'name_de' => 'Ganze Körner',
            'name_it' => 'Grani interi',
        ]);

        factory(Type::class)->create([
            'name_en' => 'Ground',
            'name_fr' => 'Moulu',
            'name_de' => 'Gemahlener',
            'name_it' => 'Macinato',
        ]);
    }
}
