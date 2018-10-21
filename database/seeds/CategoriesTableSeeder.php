<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class)->create([
            'name' => $name = 'Beauté & bien-être',
            'slug' => str_slug($name)
        ]);

        factory(Category::class)->create([
            'name' => $name = 'Bijoux & accessoires',
            'slug' => str_slug($name)
        ]);
        
        factory(Category::class)->create([
            'name' => $name = 'Vêtements',
            'slug' => str_slug($name)
        ]);
        
        factory(Category::class)->create([
            'name' => $name = 'Maison & ameublement',
            'slug' => str_slug($name)
        ]);
        
        factory(Category::class)->create([
            'name' => $name = 'Jouets & divertissement',
            'slug' => str_slug($name)
        ]);
        
        factory(Category::class)->create([
            'name' => $name = 'Art & collections',
            'slug' => str_slug($name)
        ]);
        
        factory(Category::class)->create([
            'name' => $name = 'Papeterie',
            'slug' => str_slug($name)
        ]);
        
        factory(Category::class)->create([
            'name' => $name = 'Produits locaux',
            'slug' => str_slug($name)
        ]);
    }
}
