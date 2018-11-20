<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

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
                'en' => 'Jewelry & accessories',
                'fr' => 'Bijoux & accessoires',
                'de' => 'Schmuck & Zubehör',
                'it' => 'Gioielli & accessori',
            ],
            'slug' => str_slug($name['en']),
            'order' => 1,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Clothing',
                'fr' => 'Vêtements',
                'de' => 'Kleidung',
                'it' => 'Vestiti',
            ],
            'slug' => str_slug($name['en']),
            'order' => 2,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Beauty & Wellness',
                'fr' => 'Beauté & bien-être',
                'de' => 'Schönheit & Wellness',
                'it' => 'Bellezza & benessere',
            ],
            'slug' => str_slug($name['en']),
            'order' => 3,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Home & Furnishings',
                'fr' => 'Maison & ameublement',
                'de' => 'Haus & Einrichtung',
                'it' => 'Casa & arredamento',
            ],
            'slug' => str_slug($name['en']),
            'order' => 4,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Stationery & Party',
                'fr' => 'Papeterie & Fêtes',
                'de' => 'Schreibwaren & Party',
                'it' => 'Cartoleria e feste',
            ],
            'slug' => str_slug($name['en']),
            'order' => 5,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Toys & Entertainment',
                'fr' => 'Jouets & divertissement',
                'de' => 'Spielzeuge & Unterhaltung',
                'it' => 'Giocattoli & intrattenimento',
            ],
            'slug' => str_slug($name['en']),
            'order' => 6,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Art',
                'fr' => 'Art',
                'de' => 'Kunst',
                'it' => 'Arte',
            ],
            'slug' => str_slug($name['en']),
            'order' => 7,
        ]);

        factory(Category::class)->create([
            'name' => $name = [
                'en' => 'Local products',
                'fr' => 'Produits locaux',
                'de' => 'Lokale Produkte',
                'it' => 'Prodotti locali',
            ],
            'slug' => str_slug($name['en']),
            'order' => 8,
        ]);
    }
}
