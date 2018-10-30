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
            'name_en' => $name_en = 'Beauty & Wellness',
            'name_fr' => $name_fr = 'Beauté & bien-être',
            'name_de' => $name_de = 'Schönheit & Wellness',
            'name_it' => $name_it = 'Bellezza & benessere',
            'slug' => str_slug($name_en),
        ]);

        factory(Category::class)->create([
            'name_en' => $name_en = 'Jewelry & accessories',
            'name_fr' => $name_fr = 'Bijoux & accessoires',
            'name_de' => $name_de = 'Schmuck & Zubehör',
            'name_it' => $name_it = 'Gioielli & accessori',
            'slug' => str_slug($name_en),
        ]);
        
        factory(Category::class)->create([
            'name_en' => $name_en = 'Clothing',
            'name_fr' => $name_fr = 'Vêtements',
            'name_de' => $name_de = 'Kleidung',
            'name_it' => $name_it = 'Vestiti',
            'slug' => str_slug($name_en),
        ]);
        
        factory(Category::class)->create([
            'name_en' => $name_en = 'Home & Furnishings',
            'name_fr' => $name_fr = 'Maison & ameublement',
            'name_de' => $name_de = 'Haus & Einrichtung',
            'name_it' => $name_it = 'Casa & arredamento',
            'slug' => str_slug($name_en),
        ]);
        
        factory(Category::class)->create([
            'name_en' => $name_en = 'Toys & Entertainment',
            'name_fr' => $name_fr = 'Jouets & divertissement',
            'name_de' => $name_de = 'Spielzeuge & Unterhaltung',
            'name_it' => $name_it = 'Giocattoli & intrattenimento',
            'slug' => str_slug($name_en),
        ]);
        
        factory(Category::class)->create([
            'name_en' => $name_en = 'Art & collections',
            'name_fr' => $name_fr = 'Art & collections',
            'name_de' => $name_de = 'Kunst & Sammlungen',
            'name_it' => $name_it = 'Arte & collezioni',
            'slug' => str_slug($name_en),
        ]);
        
        factory(Category::class)->create([
            'name_en' => $name_en = 'Stationery',
            'name_fr' => $name_fr = 'Papeterie',
            'name_de' => $name_de = 'Schreibwaren',
            'name_it' => $name_it = 'Cartoleria',
            'slug' => str_slug($name_en),
        ]);
        
        factory(Category::class)->create([
            'name_en' => $name_en = 'Local products',
            'name_fr' => $name_fr = 'Produits locaux',
            'name_de' => $name_de = 'Lokale Produkte',
            'name_it' => $name_it = 'Prodotti locali',
            'slug' => str_slug($name_en),
        ]);

        factory(Category::class)->create([
            'name_en' => $name_en = 'Shoes',
            'name_fr' => $name_fr = 'Chaussures',
            'name_de' => $name_de = 'Schuhe',
            'name_it' => $name_it = 'Scarpe',
            'slug' => str_slug($name_en),
            'parent_id' => 3
        ]);

        factory(Category::class)->create([
            'name_en' => $name_en = 'Gloves',
            'name_fr' => $name_fr = 'Gants',
            'name_de' => $name_de = 'Handschuhe',
            'name_it' => $name_it = 'Guanti',
            'slug' => str_slug($name_en),
            'parent_id' => 3
        ]);
    }
}
