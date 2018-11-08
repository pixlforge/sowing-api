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
            'name' => $name = [
                'en' => 'Beauty & Wellness',
                'fr' => 'Beauté & bien-être',
                'de' => 'Schönheit & Wellness',
                'it' => 'Bellezza & benessere',
            ],
            'slug' => str_slug($name['en']),
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Jewelry & accessories',
                'fr' => 'Bijoux & accessoires',
                'de' => 'Schmuck & Zubehör',
                'it' => 'Gioielli & accessori',
            ],
            'slug' => str_slug($name['en']),
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Clothing',
                'fr' => 'Vêtements',
                'de' => 'Kleidung',
                'it' => 'Vestiti',
            ],
            'slug' => str_slug($name['en']),
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Home & Furnishings',
                'fr' => 'Maison & ameublement',
                'de' => 'Haus & Einrichtung',
                'it' => 'Casa & arredamento',
            ],
            'slug' => str_slug($name['en']),
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Toys & Entertainment',
                'fr' => 'Jouets & divertissement',
                'de' => 'Spielzeuge & Unterhaltung',
                'it' => 'Giocattoli & intrattenimento',
            ],
            'slug' => str_slug($name['en']),
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Art & collections',
                'fr' => 'Art & collections',
                'de' => 'Kunst & Sammlungen',
                'it' => 'Arte & collezioni',
            ],
            'slug' => str_slug($name['en']),
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Stationery',
                'fr' => 'Papeterie',
                'de' => 'Schreibwaren',
                'it' => 'Cartoleria',
            ],
            'slug' => str_slug($name['en']),
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Local products',
                'fr' => 'Produits locaux',
                'de' => 'Lokale Produkte',
                'it' => 'Prodotti locali',
            ],
            'slug' => str_slug($name['en']),
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Shoes',
                'fr' => 'Chaussures',
                'de' => 'Schuhe',
                'it' => 'Scarpe',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => 3
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Gloves',
                'fr' => 'Gants',
                'de' => 'Handschuhe',
                'it' => 'Guanti',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => 3
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Coffee',
                'fr' => 'Café',
                'de' => 'Kaffee',
                'it' => 'Caffè',
            ],
            'slug' => str_slug($name['en']),
            'parent_id' => 8
        ]);
    }
}
